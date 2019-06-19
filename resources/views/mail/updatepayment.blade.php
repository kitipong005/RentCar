@component('mail::message')
@component('mail::panel')
<h4 class="confirm">ตรวจสอบการชำระเงิน</h4>
<p style="color:red; text-align:center;"> (โปรดแสดงอีเมลย์นี้เพื่อยืนยันให้แก่เจ้าหน้าที่ในการ) <p>
@endcomponent
@component('mail::table')
| รหัสการจ่ายเงิน :       | {{$payment->id}} |
|---------------:|:-----------:|
| ธราคาร :              | {{$payment->bank}} |
| payment :         | {{$payment->payment}} |
| วันที่ :    | {{$payment->date}} |
| เวลา :      | {{$payment->time}} |
| ราคา :       | {{$payment->price}} |
@endcomponent
@php
    // $url = 'http://127.0.0.1:8000/cars/book/check?id_book='.$book->id;
    $url = action('Admin\ConfirmBookController@ConfirmBookDetail',['id'=>$payment->id,'book'=>$payment->book_id]);
@endphp
@component('mail::button', ['url' => $url, 'color' => 'green'])
 ดูรายละเอียด
@endcomponent
{{-- <h5>***** โปรดแสดงอีเมลย์นี้เพื่อยืนยันให้แก่เจ้าหน้าที่ในการส่งมอบรถ *****</h5> --}}
@endcomponent