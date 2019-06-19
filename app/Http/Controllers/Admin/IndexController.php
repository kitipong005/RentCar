<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;

class IndexController extends Controller
{
    //
    public function Index()
    {
        //dd(Session::get('uri'));
        if(Session::has('uri'))
        {
            $url = Session::get('uri');
            Session::forget('uri');
            return redirect($url);
        }
        return view('admin.index');
    }
}
