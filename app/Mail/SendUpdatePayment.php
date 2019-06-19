<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use App\Payments;

class SendUpdatePayment extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($payment)
    {
        //
        $this->payment = $payment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //dd($this->payment);
        $payment = Payments::with(['book' => function($query){
            $query->where('id','=',$this->payment->book_id)->where('status','=',0);
        }])->where('id','=',$this->payment->id)->first();
        //dd($payment);
        return $this->subject('Payment from Customer')->markdown('mail.updatepayment',['payment'=>$payment])->to('cnxdeliverycm@gmail.com','ConfirmPayment');
    }
}
