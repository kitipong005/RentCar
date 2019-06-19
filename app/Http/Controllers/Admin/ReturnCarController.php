<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Payments;
use App\Car;
use Session;

class ReturnCarController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function returnCar()
    {
        $payments = Payments::with('book','book.timestart','book.timeend','book.landmark')->where('status','!=',1)->orderBy('updated_at','desc')->paginate(15);
        return view('admin.ReturnCar',['payments' => $payments]);
    }
    public function returnCarUpdate(Request $request)
    {
        //dd($request);
        $payment = Payments::find($request->id);
        $payment->status = 3;
        $payment->save();
        if($payment == true)
        {
            $car = Car::find($request->car_id);
            $car->count = $car->count + 1;
            $car->save();
            Session::flash('success','success');
            return redirect()->action('Admin\ReturnCarController@returnCar');
        }
        else
        {
            Session::flash('error','error');
            return redirect()->action('Admin\ReturnCarController@returnCar');
        }
            
    }
}
