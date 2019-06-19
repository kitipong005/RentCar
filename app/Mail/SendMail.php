<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use App\Book;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //dd($this->data,'mail');
        $book = Book::with('car','landmark','timestart','timeend')->where('id','=',($this->data->id))->first();
        //dd($book);
        return $this->subject('Rent Cars Detail from nxdeliverycarandbike.com')->markdown('mail.carbook',['book'=>$book])->to($book->email)->from('cnxdeliverycm@gmail.com','cnxderivery');
    }
}
