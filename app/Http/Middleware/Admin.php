<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;
use Route;
use Request;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //dd(Request::fullUrl());
        if(Auth::check())
        {
            if(Auth::user()->isAdmin == 1 )
            {
                //dd(Session::get('uri'));
                return $next($request);
            }
        }
        Session::put('uri',Request::fullUrl());
        Session::flash('admin','You have not admin access');          
        return redirect('/');

    }
}
