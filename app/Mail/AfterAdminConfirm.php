<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use App\Book;

class AfterAdminConfirm extends Mailable
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
        $book = Book::with('car','landmark','timestart','timeend')->where('id','=',$request->book_id)->first();
        return $this->subject('Confirm Payment for rent car')->markdown('mail.confirmpayment',['book'=>$book])->to($book->email)->from('cnxdeliverycm@gmail.com','Confirm Payment');
    }
}
