@component('mail::message')
@component('mail::panel')
<h4 class="noconfirm">ยังไม่ได้ทำการชำระเงิน</h4>
<h5>ใบจองนี้จะหมดในเวลา {{$book->exp}}</h5>
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
{{-- @component('mail::button', ['url' => 'http://127.0.0.1:8000/cars/book/payment?booking={{$book->id}}', 'color' => 'green']) --}}
@php
    // $url = 'http://127.0.0.1:8000/cars/book/check?id_book='.$book->id;
    $url = action('BookController@checkcart',['id'=>$book->id]);
@endphp
@component('mail::button', ['url' => $url, 'color' => 'green'])
 ดูรายการจอง
@endcomponent
@endcomponent