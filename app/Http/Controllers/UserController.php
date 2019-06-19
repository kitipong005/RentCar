<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use Session;

class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function view_profile()
    {
        return view('userProfile');
    }
    public function update_profile(Request $request)
    {
        //dd($request);
        $user = User::find(Auth::user()->id);
        $user->name = $request->fname.' '.$request->lname;
        $user->save();
        Session::flash('success','Edit data success !!!');
        //dd($user);
        return redirect()->action('UserController@view_profile');

    }
}
