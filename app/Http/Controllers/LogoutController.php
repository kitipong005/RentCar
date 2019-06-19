<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Auth;

class LogoutController extends Controller
{
    //
    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        session()->regenerate();
        return redirect('/');
    }
}
