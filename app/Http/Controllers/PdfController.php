<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Car;
use App\Timestart;
use App\Timeend;
use App\Payments;
use PDF;

class PdfController extends Controller
{
    //
    public function generate_pdf_rent_car($payment)
    {
        //dd($payment);
        $dataPdf = $this->get_data_write_pdf($payment);
        //dd($dataPdf);
        $data = [
            'payment_type' => $dataPdf->bank,
            'date_pay' => $dataPdf->date,
            'id' => $dataPdf->book->id,
            'car_detail' => $dataPdf->book->car->brand->name.' '.$dataPdf->book->car->model->name,
            'date_borrow' => $dataPdf->book->s_date,
            'date_return' => $dataPdf->book->e_date,
            'time_borrow' => $dataPdf->book->timestart->detail,
            'time_return' => $dataPdf->book->timeend->detail,
            'landmark' => $dataPdf->book->landmark->nameEN,
            'code' => $dataPdf->book->code,
            'name' => $dataPdf->book->name,
            'email' => $dataPdf->book->email,
            'phone' => $dataPdf->book->phone,
            'price' => $dataPdf->book->price,
            'priceTotal' => $dataPdf->book->price,
            'days' => $dataPdf->book->days,
            'times' => $dataPdf->book->times,
        ];
        //dd($data);
        $pdf = PDF::loadView('pdf_rent_car',$data);
        return @$pdf->stream();
    }
    public function get_data_write_pdf($payment)
    {
        return $book = Payments::with('book','book.car.brand','book.landmark','book.timestart','book.timeend','book.car.model')->where('id','=',$payment)->first();
    }

    public function generate_pdf_return_car($payment)
    {
        $dataPdf = Payments::with('book','book.car.brand','book.landmark','book.timestart','book.timeend','book.car.model')->where('id','=',$payment)->first();
        $data = [
            'payment_type' => $dataPdf->bank,
            'date_pay' => $dataPdf->date,
            'id' => $dataPdf->book->id,
            'car_detail' => $dataPdf->book->car->brand->name.' '.$dataPdf->book->car->model->name,
            'date_borrow' => $dataPdf->book->s_date,
            'date_return' => $dataPdf->book->e_date,
            'time_borrow' => $dataPdf->book->timestart->detail,
            'time_return' => $dataPdf->book->timeend->detail,
            'landmark' => $dataPdf->book->landmark->nameEN,
            'code' => $dataPdf->book->code,
            'name' => $dataPdf->book->name,
            'email' => $dataPdf->book->email,
            'phone' => $dataPdf->book->phone,
            'price' => $dataPdf->book->price,
            'priceTotal' => $dataPdf->book->price,
            'days' => $dataPdf->book->days,
            'times' => $dataPdf->book->times,
        ];
        //dd($data);
        $pdf = PDF::loadView('pdf_return_car',$data);
        return @$pdf->stream();
    }
}
