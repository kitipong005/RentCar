<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use DB;
use App\User;
use Keygen;
use Auth;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
    }


    //----------------------------------------------------
    //--------------- Login with Website -----------------
    //----------------------------------------------------
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|max:255|email',
            'password' => 'required|max:255|min:6',
         ]);
            if (Auth::attempt(array('email' => $request->email, 'password' => $request->password, 'isAdmin' => 1)))
            {
                return redirect('/admin');
            }
            else 
            {
                if (Auth::attempt(array('email' => $request->email, 'password' => $request->password, 'isAdmin' => 0)))
                {
                    return redirect('/');
                }
                else
                {
                    return redirect('/')->withErrors(['Login Fails Email or Password Invalid !!!']);
                }
            }
        }
    
    //----------------------------------------------------
    //--------------- Login with Facebook ----------------
    //----------------------------------------------------
    public function redirectToFacebookProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookProviderCallback()
    {
        $user = Socialite::driver('facebook')->stateless()->user();
        $chk_user = $this->checkUser($user);
        if($chk_user)
        {
            if (Auth::attempt(array('email' => $user->email, 'password' => $user->id)))
            {
                return redirect('/');
            }
            else
            {
                \Session::flash('error','error');
                return redirect('/');
            }
        }
        else {
            while(true){
                $code = $this->generateCode();

                //--- code not duplicate
                if($this->chkCode($code) == true){
                    $result = User::create([
                        'email' => $user->email,
                        'password' => bcrypt($user->id),
                        'name' => $user->name,
                        'code' => $code,
                        'score' => 0,
                        'status' => "fb",
                        'remember_token' => $user->token,
                    ]);
                    if($result == true)
                    {
                        if (Auth::attempt(array('email' => $user->email, 'password' => $user->id)))
                        {
                            return redirect('/');
                        }
                    }
                }
            }
        }
    }
    //----------------------------------------------------
    //--------------- Login with Google ------------------
    //----------------------------------------------------
    public function redirectToGoogleProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleProviderCallback()
    {
        $user = Socialite::driver('google')->stateless()->user();
        $chk_user = $this->checkUser($user);
        //dd($chk_user);
        if($chk_user)
        {
            if (Auth::attempt(array('email' => $user->email, 'password' => $user->id)))
            {
                return redirect('/');
            }
            else
            {
                \Session::flash('error','error');
                return redirect('/');
            }
        }
        else {
            while(true){
                $code = $this->generateCode();
                //--- code not duplicate
                //dd($user->token);
                if($user->name == null)
                {
                    //dd($user);
                    $user->name = str_replace('@gmail.com','',$user->email);
                }
                //dd($user,'dont');
                if($this->chkCode($code) == true){
                    $result = new User();
                    $result->email = $user->email;
                    $result->password = bcrypt($user->id);
                    $result->name = $user->name;
                    $result->code = $code;
                    $result->score = 0;
                    $result->status = 'gg';
                    //$result->remember_token = $user->token;
                    $result->save();
                    if($result == true)
                    {
                        if (Auth::attempt(array('email' => $user->email, 'password' => $user->id)))
                        {
                            return redirect('/');
                        }
                    }
                }
            }
        }
    }

    //---------------------
    // check user duplicate
    //---------------------
    public function checkUser($user)
    {
        $chk_user = DB::table('users')
            ->where('email','=',$user->email)
            ->first();
        return $chk_user;
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

    //---------------------
    // check code duplicate
    //---------------------
    public function chkCode($code)
    {
        $result = DB::table('users')
            ->where('code','=',$code)
            ->get();
        if(!$result->isEmpty())
        {
            return false;    
        }
        else {
            return true;
        }
    }
}
