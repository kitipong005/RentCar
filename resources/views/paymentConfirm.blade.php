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
<div class="container mt-5" style="background-color:white; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); border-radius: 25px;">
    <br>
    {{-- start detail book --}}
    <table class="table text-center">
        <thead class="thead-dark">
            <tr>
                <th scope="col">รายละเอียดการสั่งซื้อ</th>
            </tr>
        </thead>
    </table>
    <div class="row">
        <div class="col-md-3 mt-auto">
            <img src="{{asset('img/cars/'.$payment->book->car->pic)}}" alt="" width="100%;" height="250px;" class="rounded border border-dark">
        </div>
        <div class="col-md-1">
        </div>
        {{-- start detail address --}}
        <div class="col-md-8">
            @if ($payment->bank == 'paypal')
                <h2 style="color:green" class="text-center">ชำระเงินด้วย {{$payment->bank}}</h2>
                <p style="color:green" class="text-center">(ยืนยันเมื่อเวลา {{$payment->created_at}})</p>
            @else
                <h2 style="color:green" class="text-center">ชำระเงินด้วย</h2>
                <p style="color:green" class="text-center">(ธนาคาร {{$payment->bank}} วันที่ {{$payment->date}} เวลา {{$payment->time}})</p>
            @endif
            <div class="w-100 border"></div>
            <br>
            <table class="table text-center table-bordered">
                <thead class="thead-dark">
                    <tr>
                            <th scope="col" style="width:25%">รหัสการจอง:</th>
                            <td>{{$payment->book->code}}</td>
                    </tr>
                    <tr>
                        <th scope="col" style="width:25%">ชื่อ :</th>
                        <td>{{$payment->book->name}}</td>
                    </tr>
                    <tr>
                        <th scope="col" style="width:25%">เบอร์โทร :</th>
                        <td>{{$payment->book->phone}}</td>
                    </tr>
                    <tr>
                        <th scope="col" style="width:25%">ที่อยู่ในการจัดส่ง :</th>
                        <td>{{$payment->book->landmark->nameTH}}</td>
                    </tr>
                </thead>
            </table>
        </div>
        {{-- end detail address --}}
    </div>
    <div class="w-100 border"></div>
    {{-- end row detail time and price --}}
    <div class="row">
        <div class="col-md-4 order-md-1 order-2" style="margin-top:2%">
            <div>
                    <a href="{{action('IndexController@index')}}" role="button" class="btn btn-primary btn-block button"><span>กลับสู่หน้าหลัก</span></a>
                    <a href="{{action('CarController@carshowform')}}" role="button" class="btn btn-success btn-block button"><span>กลับสู่หน้าเลือกรถ</span></a>
            </div>
        </div>
        <div class="col-md-8 order-md-2 order-1" style="margin-top:2%">
            <table class="table text-center table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col" style="width:25%">เวลา :</th>
                        <td>{{$payment->book->s_date}} {{$payment->book->timestart->detail}} ถึง {{$payment->book->e_date}} {{$payment->book->timeend->detail}}</td>
                    </tr>
                    <tr>
                        <th scope="col" style="width:25%">รวมเวลา :</th>
                        <td>{{$payment->book->days}} วัน {{$payment->book->times}} ชั่วโมง</td>
                    </tr>
                    <tr>
                        <th scope="col" style="width:25%">เป็นเงินทั้งหมด :</th>
                        <td>{{$payment->book->price}} Bath</td>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
    {{-- end row detail time and price --}}
    <br>
</div>
{{-- end detail book --}}
@endsection