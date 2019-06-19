@extends('layouts.main') 
@section('css')
<style>
    .button span {
        cursor: pointer;
        display: inline-block;
        position: relative;
        transition: 0.5s;
    }

    .button span:after {
        content: '\00bb';
        position: absolute;
        opacity: 0;
        top: 0;
        right: -20px;
        transition: 0.5s;
    }

    .button:hover span {
        padding-right: 25px;
    }

    .button:hover span:after {
        opacity: 1;
        right: 0;
    }
</style>
@endsection
 
@section('contents')
@if (Session::has('error'))
    <script>alert('Booking นี้ได้รับการอนุมัติ หรือลบไปแล้ว')</script>
@endif
<div class="container mt-5" style="background-color:white; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); border-radius: 25px;">
    <br> {{-- start detail payment --}}
    <table class="table text-center">
        <thead class="thead-dark">
            <tr>
                <th scope="col">รายละเอียดการชำระเงิน</th>
            </tr>
        </thead>
    </table>
    <div class="row">
        <div class="col-md-4 col-12 mt-auto">
            @if ($payment->pic)
            <img src="{{asset('img/payment/'.$payment->pic)}}" alt="" width="100%;" height="350px;" class="rounded border border-dark">            
            @else
            <img src="{{asset('img/no-pic.jpg')}}" alt="" width="auto" height="450px;" class="rounded border border-dark">            
            @endif
        </div>
        <div class="col-md-1">
        </div>
        {{-- start detail payment --}}
        <div class="col-md-7">
            <table class="table text-center table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" style="width:25%">รหัสการจอง:</th>
                        {{-- <td><a href="{{url('รถเช่า/รายการรถเช่า/ยืนยัน/'.$payment->book_id)}}" target="_blank" class="btn btn-success" role="button">{{$payment->book_id}}</a></td> --}}
                        <td><a href="{{action('BookController@paymentConfirm',['book'=>$payment->book_id])}}" target="_blank" class="btn btn-success" role="button">{{$payment->book_id}}</a></td>
                    </tr>
                    <tr>
                        <th scope="col" style="width:25%">วิธีการชำระ :</th>
                        <td>{{$payment->bank}}</td>
                    </tr>
                    <tr>
                        <th scope="col" style="width:25%">PaypalID :</th>
                        <td>{{$payment->payment}}</td>
                    </tr>
                    <tr>
                        <th scope="col" style="width:25%">วันที่ :</th>
                        <td>{{$payment->date}}</td>
                    </tr>
                    <tr>
                        <th scope="col" style="width:25%">เวลา :</th>
                        <td>{{$payment->time}}</td>
                    </tr>
                    <tr>
                        <th scope="col" style="width:25%">ราคา :</th>
                        <td>{{$payment->price}}</td>
                    </tr>
                    <tr>
                        <th scope="col" style="width:25%">บันทึกเมื่อ :</th>
                        <td>{{$payment->created_at}}</td>
                    </tr>
                </thead>
            </table>
            @if ($payment->book != null)
            <form action="{{action('Admin\ConfirmBookController@ConfirmBookUpdate')}}" method="post">
                {{ csrf_field() }}
                    <input type="hidden" name="id" value="{{$payment->id}}">
                    <input type="hidden" name="book_id" value="{{$payment->book_id}}">
                    <input type="hidden" name="car_id" value="{{$payment->book->car_id}}">
                    <button type="submit" class="btn btn-success btn-block">ยืนยันการเช่ารถ</button>
                    <a href="{{action('Admin\ConfirmBookController@ConfirmBookDelete',['id'=>$payment->id])}}" class="btn btn-danger btn-block" onclick="return confirm('คุณต้องการลบข้อมูลนี้หรือไม่')" role="button">ลบข้อมูล</a>
            </form>
            @else
                <h2 style="color:red" class="text-center">รหัส Booking นี้ได้มีการยืนยันการจ่ายเงินเรียบร้อยแล้ว !!!!</h2>
                <a href="{{action('Admin\ConfirmBookController@ConfirmBookDelete',['id'=>$payment->id])}}" class="btn btn-danger btn-block" onclick="return confirm('คุณต้องการลบข้อมูลนี้หรือไม่')" role="button">ลบข้อมูล</a>
            @endif
        </div>
        {{-- end detail payment --}}
    </div>
    <br>
</div>
{{-- end detail payment --}}
@endsection