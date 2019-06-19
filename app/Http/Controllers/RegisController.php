<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use Auth;
use App\User;

class RegisController extends Controller
{
    //
    public function register(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|max:255|email',
            'password' => 'required|max:255|string|confirmed|min:6',
            'fname' => 'required|max:255|string',
            'lname' => 'required|max:255|string',
         ]);
         DB::beginTransaction();
         $chk_user = app('App\Http\Controllers\LoginController')->checkUser($request);
         if($chk_user)
         {
            return redirect('/')->withErrors(['Register Fails Have Email in System Please new Register!!!']);
         }
         else {
            try 
            {
                while(true){
                    $code = app('App\Http\Controllers\LoginController')->generateCode();
    
                    //--- code not duplicate
                    if(app('App\Http\Controllers\LoginController')->chkCode($code) == true){
                        $user = new User();
                        $user->email = $request->email;
                        $user->password = bcrypt($request->password);
                        $user->name = $request->fname.' '.$request->lname;
                        $user->code = $code;
                        $user->score = 0;
                        $user->status = 'web';
                        $user->remember_token = $request->_token;
                        $user->save();
                         DB::commit();
                        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                            return redirect('/');
                        }
                            return redirect('/')->withErrors(['Login Fails Email or Password Invalid !!!']);
                    }
                }
            }
            catch(Exception $e)
            {
                DB::rollBack();
                return redirect()->back()
                ->withErrors([$e->getMessage()]);
            }
         }
            

    }
}
