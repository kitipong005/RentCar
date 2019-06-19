<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Attraction;
use App\Car;

class IndexController extends Controller
{
    //
    public function index()
    {
        $attractions = Attraction::take(2)->get();
        session(['language' => 'th']);
        $cars = Car::where('count','!=',0)->inRandomOrder()->limit(6)->get();
        return view('index',compact('attractions','cars'));
    }

    public function indexEN()
    {
        session(['language' => 'en']);
        return view('en.index');
    }

    public function howto()
    {
        return view('howto');
    }
}
