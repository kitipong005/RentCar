<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\SendMail;
use  App\Mail\ConfirmPayment;
use App\Mail\SendUpdatePayment;
use App\Mail\AfterAdminConfirm;
use App\Book;

class MailController extends Controller
{
    //
    public function sendMail($book)
    {
        //dd($book,'sentmail');
        Mail::send(new sendMail($book));
    }
    public function confirm()
    {
        //dd($book,'sentmail');
        Mail::send(new ConfirmPayment());
    }
    public function sendUpdatePayment($payment)
    {
        //dd($book);
        Mail::send(new SendUpdatePayment($payment));
    }
    public function afterAdminConfirm()
    {
        Mail::send(new AfterAdminConfirm());
    }
}
