@extends('layouts.main') 
@section('header')
    @include('layouts.navbar')
@endsection
 
@section('contents')
<div class="container mt" style="background-color:white; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); border-radius: 25px;"> 
    <div class="row">
        <table class="table text-center">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">วิธีการสั่งซื้อสินค้า</th>
                </tr>
            </thead>
        </table>
        {{-- start bank list --}}
        <div class="col-md-4">
            <img src="{{asset('img/howto1.png')}}" alt="" width="350px" height="auto">
            <a href="{{action('CarController@carshowform')}}"><p style="text-align:center; color:chocolate">เลือกรถเช่าที่ท่านต้องการ</p></a>
        </div>
        <div class="col-md-4">
            <img src="{{asset('img/howto2.png')}}" alt="" width="350px" height="auto">
            <p style="text-align:center; color:chocolate">กรอกรายละเอียดให้ครบถ้วน</p>
        </div>
        <div class="col-md-4">
            <img src="{{asset('img/howto3.png')}}" alt="" width="350px" height="auto">
            <a href="{{action('PaymentController@howtopayment')}}"><p style="text-align:center; color:chocolate">ชำระค่าสินค้า</p></a>
        </div>
        <div class="col-md-4">
                <img src="{{asset('img/howto4.png')}}" alt="" width="350px" height="auto">
                <p style="text-align:center; color:chocolate">แจ้งการชำระเงินผ่านทางเว็บไซต์ในกรณีทำการจ่ายผ่านการโอนเงิน</p>
            </div>
            <div class="col-md-4">
                <img src="{{asset('img/howto5.png')}}" alt="" width="350px" height="auto">
                <p style="text-align:center; color:chocolate">เมื่อทางร้านตรวจสอบการชำระเงินเรียบร้อยแล้วจะมีอีเมล์ยืนยัน ส่งให้ลูกค้า เพื่อยืนยันต่อเจ้าหน้าที่ในการรับรถ</p>
            </div>
            <div class="col-md-4">
                <img src="{{asset('img/howto6.png')}}" alt="" width="350px" height="auto">
                <p style="text-align:center; color:chocolate">ทางร้านทำการจัดส่งรถเช่าตามที่อยู่ที่ผู้ใช้ได้กรอกไว้</p>
            </div>
    </div>
    {{-- end row 1 --}}
    <br>
    <br>
</div>
@endsection