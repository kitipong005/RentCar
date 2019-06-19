<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Book;
use Illuminate\Http\Request;

class ConfirmPayment extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {
        //dd($request);
        $book = Book::with('car','landmark','timestart','timeend')->where('id','=',$request->booking)->first();
        return $this->subject('Confirm Payment for rent car')->markdown('mail.confirmpayment',['book'=>$book])->to($book->email)->from('cnxdeliverycm@gmail.com','Confirm Payment');
    }
}
