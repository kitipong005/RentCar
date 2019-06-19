@component('mail::message')
@component('mail::panel')
<h4 class="confirm">ชำระเงินเรียบร้อยแล้ว</h4>
<p style="color:red; text-align:center;"> (โปรดแสดงอีเมลย์นี้เพื่อยืนยันให้แก่เจ้าหน้าที่ในการส่งมอบรถ) <p>
@endcomponent
@component('mail::table')
| รหัสการจอง :       | {{$book->code}} |
|---------------:|:-----------:|
| ชื่อ :              | {{$book->name}} |
| เบอร์โทร :         | +{{$book->phone_id}} {{$book->phone}} |
| ที่อยู่ในการจัดส่ง :    | {{$book->landmark->nameTH}} |
| เวลา :      | {{$book->s_date}} {{$book->timestart->detail}} ถึง {{$book->e_date}} {{$book->timeend->detail}} |
| เป็นเวลา :       | {{$book->days}} วัน {{$book->times}} ชั่วโมง |
| เป็นเงินทั้งหมด :      | {{$book->price}} |
@endcomponent
@php
    // $url = 'http://127.0.0.1:8000/cars/book/check?id_book='.$book->id;
    $url = action('BookController@paymentConfirm',['book'=>$book->id]);
@endphp
@component('mail::button', ['url' => $url, 'color' => 'green'])
 ดูรายการจอง
@endcomponent
{{-- <h5>***** โปรดแสดงอีเมลย์นี้เพื่อยืนยันให้แก่เจ้าหน้าที่ในการส่งมอบรถ *****</h5> --}}
@endcomponent