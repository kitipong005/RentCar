<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;
use App\Book;
use Auth;
use DB;
use App\Landmark;
use App\Timestart;
use App\Timeend;
use App\Payments;
use Keygen;
use App\User;
use Carbon\Carbon;
use Session;
use Image;
use App\Phone;

class BookController extends Controller
{
    //
    public function cart($id)
    {
        //dd($id);
        $cars = Car::where('id',$id)->first();
        $landmarks = Landmark::all();
        $Stimes = Timestart::all();
        $Etimes = Timeend::all();
        $phone = Phone::all();
        return view('book.cart')->with('cars', $cars)->with('landmarks', $landmarks)->with('Stimes', $Stimes)->with('Etimes', $Etimes)->with('phone', $phone);
    }
    //--------------- creat book --------------------
    public function createBook($request)
    {
        //dd($request);
        if (Auth::check()) {
            $user_id = Auth::user()->id;
        } else {
            $user_id = null;
            $user_id = $request->user_id;
        }
        $code = $this->genCode();
        DB::beginTransaction();
        try {
            $book = new Book();
            $book->car_id = $request->car_id;
            $book->user_id = $user_id;
            $book->name = $request->fname . ' ' . $request->lname;
            $book->email = $request->email;
            $book->phone_id = $request->phone_id;
            $book->phone = $request->phone;
            $book->s_date = $request->SdateBook;
            $book->s_time = $request->StimeBook;
            $book->e_date = $request->EdateBook;
            $book->e_time = $request->EtimeBook;
            // $book->addr = $request->addr;
            // $book->district = $request->district;
            // $book->amphoe = $request->amphoe;
            // $book->province = $request->province;
            // $book->zipcode = $request->zipcode;
            $book->landmark_id = $request->landmark;
            $book->code = $code;
            $book->days = $request->days;
            $book->times = $request->times;
            $book->price = $request->priceAll;
            $book->exp = Carbon::now()->addMinutes(2)->toDateTimeString();
            $book->save();        
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()
                 ->withErrors([$e->getMessage()]);
        }
        return $book;
    }
    //--------------- save book ---------------------
    public function saveBook(Request $request)
    {
        //dd($request);
        $this->validate($request, [
        'fname' => 'required|max:255|string',
        'lname' => 'required|max:255|string',
        'email' => 'required|max:255|email',
        'phone' => 'required|max:255|string',
        'SdateBook' => 'required|max:255|Date',
        'EdateBook' => 'required|max:255|Date',
        // 'addr' => 'required|max:255|string',
        // 'district' => 'required|max:255|string',
        // 'amphoe' => 'required|max:255|string',
        // 'province' => 'required|max:255|string',
        // 'zipcode' => 'required|max:255|string',
        'landmark' => 'required|max:255|string',
        'priceAll' => 'required|max:255|string',
        'car_id' => 'required|max:255|string',
        ]);
        $book = $this->createBook($request);
        if($book == true)
        {
            //dd($book);
            app('App\Http\Controllers\MailController')->sendMail($book);
            return redirect()->action('BookController@checkcart',['id'=>$book]);
        }
        else{
            return redirect()->action('BookController@cart',['id_car'=>$book->car_id]);
        }
    }
    //---------------- check cart ------------------
    public function checkcart($id)
    {
        $book = Book::with('car.model','landmark','timestart','timeend')->where('id','=',$id)->where('status','=',0)->first();
        //dd($book);
        if($book)
        {
            return view('book.checkcart',['book'=>$book]);
        }
        else return redirect()->action('CarController@carshowform');
    }
    //----------------- get Price Landmark in select  --------------
    public function getPriceLandmark(Request $request)
    {
        if($request->ajax())
        {
            $priceLandmark = Landmark::where('id','=',$request->id)->first();
            return response($priceLandmark);
        }
    }
    //=========================================================================
    //==================== After pay PayPal Success ===========================
    //=========================================================================

    //------------------- update after paypal --------------------
    public function updateBook(Request $request)
    {
        //dd($request);
        DB::beginTransaction();
        try
        {
            $payment = new Payments();
            $payment->book_id = $request->booking;
            $payment->bank = $request->bank;
            $payment->payment = $request->payment_id;
            $payment->date = $request->date;
            $payment->time = $request->time;
            $payment->price = $request->price;
            $payment->pic = $request->pic;
            $payment->status = 1;
            $payment->save();
            //dd($payment);
            $result = Book::where('id',$request->booking)
                ->update(['status'=> 1]);
            DB::commit();
            if($result == true)
            {
                app('App\Http\Controllers\MailController')->confirm();
                return redirect()->action('BookController@paymentConfirm',['book'=>$request->booking]);
            }
        }
        catch (Exception $e)
        {
            DB::rollBack();
            Session::flash('errorBooking','error');
            return redirect()->action('CarController@carshowform');
        }
    }
    //=========================================================================
    //==================== After Booking Success    ===========================
    //=========================================================================
    //--------------------- bank payment -------------------
    public function paymentcart($id)
    {
        //dd($request);
        $book = Book::where('id','=',$id)->where('status','=',0)->first();
        if($book == null)
        {
            Session::flash('errorBooking','error');
            return redirect()->action('CarController@carshowform');
        }
        else 
        {
            return view('book.paymentcart',['book'=>$book]);
        }
    }
    public function savepayment(Request $request)
    {
        //dd($request);
        if($request->file('pic'))
        {
            $payment = new Payments();
            $payment->book_id = $request->book_id;
            $payment->bank = $request->bank;
            $payment->date = $request->date_pay;
            $payment->time = $request->time_pay;
            $payment->price = $request->price;
            $payment->pic =  $this->resizePic($request,500);
            $payment->status = 0;
            $payment->save();
        }
        else{
            $payment = new Payments();
            $payment->book_id = $request->book_id;
            $payment->bank = $request->bank;
            $payment->date = $request->date_pay;
            $payment->time = $request->time_pay;
            $payment->price = $request->price;
            $payment->status = 0;
            $payment->save();
        }
        
        if($payment == true)
        {
            app('App\Http\Controllers\MailController')->sendUpdatePayment($payment);
            $book = Book::where('id','=',$payment->book_id)->where('status','=',0)->first();
            session()->flash('success', 'กรุณารอการตรวจสอบ');
            return redirect()->action('BookController@paymentConfirm',['book'=>$book]);
        }
        else return redirect()->back()->withErrors('dont','ไม่สามารถเพิ่มข้อมูลได้ กรุณาทำรายการใหม่ !!!');

    }
    //=========================================================================
    //==================== After Confirm payment    ===========================
    //=========================================================================
    public function paymentConfirm(Request $request)
    {
       //dd($request);
        $payment = Payments::with('book')->where(['book_id' => function ($query) use($request){
            $query->from('books')->select('id')->where('id','=',$request->book)->where('status','=',0);
        }])->where('status','=',0)->orderBy('created_at', 'desc')->first();
        //dd($payment);
        if($payment)
        {
            //dd($request,'รอการตรวจสอบ');
            return view('paymentWait',['payment'=>$payment]);
        }
        //payment confirm
        else 
        {
            $payment = Payments::with('book')->where(['book_id' => function ($query) use($request){
                $query->from('books')->select('id')->where('id','=',$request->book)->where('status','=',1);
            }])->where('status','=',1)->orderBy('created_at', 'desc')->first();
            if($payment)
            {
                //dd($payment,'ตรวจสอบเสร็จแล้ว');
                return view('paymentConfirm',['payment'=>$payment]);
            }
            else 
            {
                //dd($request,'ยังไม่ได้จ่ายตัง');
                // dd('error');
                //Session::flash('errorBooking','error');
                return redirect()->action('BookController@checkcart',['id'=>$request->book]);
            }
            // Session::flash('errorBooking','error');
            // return redirect()->action('CarController@carshowform');
        }
    }

    //------------------- delete book --------------------
    public function deleteBook(Request $request)
    {
        $result = Book::where('id',$request->id_car)
            ->delete();
        return $result;
    }

    //----------------- generate Code --------------------
    public function genCode()
    {
        while(true)
        {
            $code = $this->generateCode();
            $result = Book::where('code','=',$code)->where('status','<>',2)->get();
            if($result->isEmpty())
            {
                return $code;
            }
        }
    }
    public function generateCode()
    {
        return Keygen::bytes()->generate(
            function($key){
                $random = Keygen::numeric()->generate();
                return substr(md5($key . $random . strrev($key)), mt_rand(0,8), 6);
            }
        );
    }
    //--------------- check code ------------------
    public function checkCode(Request $request)
    {
        $code = trim($request->code);
        $user = User::where('code','=',$code)->get();
        return $user;
    }
    //-------------- resize pic -------------------
    public function resizePic($request,$imgwidth)
    {
        $file = $request->file('pic');
        //$imgwidth = 300;
        $folderupload = 'img/payment/';
        $filename = time() . $file->getClientOriginalName();
        $filename = str_replace(" ","",$filename);
        $file->move($folderupload, $filename);
        $targetPath = $folderupload . $filename;
        $img = Image::make($targetPath);
        if($img->width()>$imgwidth){
			$img->resize($imgwidth, null, function ($constraint) {
				$constraint->aspectRatio();
			});
         }
         $img->save($targetPath);
        return $filename;
    }
}
