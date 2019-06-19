<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;
use App\Book;

class CarController extends Controller
{
    //
    public function carshowform()
    {
        $cars = Car::with('brand','model','type')->where('count','!=',0)->orderBy('id','desc')->paginate(15);
        return view('carShowForm')->with('cars',$cars);
    }
    public function carcheckrent(Request $request)
    {
        $datas = Book::where('car_id',$request->car_id)
            ->where('status','1')
            ->get();
        $blackoutDays[] = null;
        if(!$datas->isEmpty())
        {
            foreach($datas as $index => $data)
            {
                $startDate = new \Carbon\Carbon($data->s_date);
                $endDate = new \Carbon\Carbon($data->e_date);
                $days = $startDate->diff($endDate)->days;
                for($i = 0; $i <= $days; $i++)
                {
                    if($i == 0)
                    {
                        $date = '';
                        $date = $startDate;
                        $blackoutDays[] = $date->format('Y-m-d');
                    }
                    else {
                        $date = '';
                        $date = $startDate->addDays(1);

                        $blackoutDays[] = $date->format('Y-m-d');
                    }
                }
            }
            return $blackoutDays;
        }
        else return $blackoutDays;
        
        
        //var_dump($data[0]->s_date);
        //dd($data);
        //return json_encode($data);
    } 

}
