<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Payments;
use App\Book;
use App\Car;
use Session;

class ConfirmBookController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function ConfirmBookForm()
    {
        $payments = Payments::where('status','=',0)->paginate(15);
        return view('admin.ConfirmBookForm',['payments' => $payments]);
    }
    public function ConfirmBookDetail($id,$book)
    {
        //dd($id,$book);
        // $payment = Payments::with(['book' => function($id){
        //     $query->where('$id->book_id)->where('status','=',0);
        // }])->where('$id->id)->toSql();
        $payment = Payments::with(['book' => function($query) use($book){
            $query->where('id','=',$book)->where('status','=',0);
        }])->where('id','=',$id)->first();
        return view('admin.ConfirmBookDetail',['payment' => $payment]);
    }

    public function ConfirmBookUpdate(Request $request)
    {
        //dd($request);
        $payment = payments::find($request->id);
        if($payment->status == 0)
        {
            $payment->status = 1;
            $payment->save();
            if($payment == true)
            {
                $book = Book::find($request->book_id);
                $book->status = 1;
                $book->save();
                if($book == true)
                {
                    $car = Car::find($request->car_id);
                    $car->count = $car->count - 1;
                    $car->save();
                    //dd($car);
                    app('App\Http\Controllers\MailController')->afterAdminConfirm();
                    return redirect()->action('BookController@paymentConfirm',['book'=>$book->id]);
                }
                else
                {
                    return redirect()->action('BookController@paymentConfirm',['book'=>$book->id]);
                }
            }
        }
        else {
            Session::flash('error','Booking นี้ได้รับการอนุมัติ หรือลบไปแล้ว');
            return back();   
        }
    }

    public function ConfirmBookDelete($id)
    {
        $payment = Payments::where('id','=',$id)->where('status','=',0)->first();
        $payment->delete();
        if($payment == true)
        {
            Session::flash('success','Booking นี้ได้รับการลบเรียบร้อยแล้ว !!!!');
            return redirect()->action('Admin\ConfirmBookController@ConfirmBookForm');   
        }
        else 
        {
            return redirect()->action('Admin\ConfirmBookController@ConfirmBookDetail',['id'=>$id]);
        }
    }

    public function ConfirmBookPdf()
    {
        $payments = Payments::with('book','book.timestart','book.timeend','book.landmark')->where('status','=',1)->orderBy('updated_at','desc')->paginate(15);
        //dd($payments);
        return view('admin.ConfirmBookPDF',['payments' => $payments]);
    }
    // ============================================
    // =========== after car send to customer =====
    // ============================================
    public function sendCarSuccess(Request $request)
    {
        $payment = Payments::where('id','=',$request->id)->where('status','=',1)->first();
        //$payment = Payments::find($request->id);
        $payment->status = 2;
        $payment->save();
        if($payment == true)
        {
            Session::flash('success','success');
            return redirect()->action('Admin\ConfirmBookController@ConfirmBookPdf');
        }
        else
        {
            Session::flash('error','error');
            return redirect()->action('Admin\ConfirmBookController@ConfirmBookPdf');
        }
    }

    //------------- confirm success -----------
    public function ConfirmSuccess()
    {
        $payments = Payments::where('status','=',2)->paginate(15);
        return view('admin.ConfirmSuccess',['payments' => $payments]);
    }
}
