@extends('layouts.main') 
@section('css')
<link rel="stylesheet" href="{{asset('css/timeline.css')}}">
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
@if (Session::has('success'))
    <script>
        alert('กรุณารอการตรวจสอบจากเจ้าหน้าที่ !!!');
    </script>
@endif
<div class="container mt-5" style="background-color:white; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); border-radius: 25px;">
    <br>
    {{-- start timeline --}}
    <div class="row">
            <div class="col-md-12 col-12">
                <div class="page-header">
                    <img src="{{asset('img/slogan.png')}}" alt="" width="auto" height="260px">
                </div>
                <div style="display:inline-block;width:100%;overflow-y:auto;">
                    <ul class="timeline timeline-horizontal">
                        <li class="timeline-item">
                            <div class="timeline-badge"><i class="fa fa-motorcycle"></i></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title border-bottom border-secondary">ขั้นตอนที่ 1</h4>
                                    <div class="w-100"></div>
                                </div>
                                <div class="timeline-body">
                                    <p>เลือกรถเช่าและกรอกรายละเอียดให้ครบถ้วน
                                    </p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-item">
                            <div class="timeline-badge"><i class="fa fa-motorcycle"></i></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title border-bottom border-secondary">ขั้นตอนที่ 2</h4>
                                </div>
                                <div class="timeline-body">
                                    <p>ตรวจสอบรายการเช่าและวิธีการชำระเงิน</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-item">
                            <div class="timeline-badge"><i class="fa fa-motorcycle"></i></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title border-bottom border-secondary">ขั้นตอนที่ 3</h4>
                                </div>
                                <div class="timeline-body">
                                    <p>แจ้งการชำระเงิน</p>
                                </div>
                            </div>
                        </li>
                        <li class="timeline-item">
                            <div class="timeline-badge danger"><i class="fa fa-motorcycle"></i></div>
                            <div class="timeline-panel">
                                <div class="timeline-heading">
                                    <h4 class="timeline-title border-bottom border-secondary">ขั้นตอนที่ 4</h4>
                                </div>
                                <div class="timeline-body">
                                    <p>รอการยืนยันจากเจ้าหน้าที่</p>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        {{-- end timeline --}}
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
                <h1 style="color:orange" class="text-center">รอการอนุมัติจากเจ้าหน้าที่</h1>
                <h2 style="color:orange" class="text-center">ชำระเงินด้วย</h2>
                <p style="color:orange" class="text-center">(ธนาคาร {{$payment->bank}} วันที่ {{$payment->date}} เวลา {{$payment->time}})</p>
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
                    <a href="{{url('/')}}" role="button" class="btn btn-primary btn-block button"><span>กลับสู่หน้าหลัก</span></a>
                    <a href="{{url('cars/form')}}" role="button" class="btn btn-success btn-block button"><span>กลับสู่หน้าเลือกรถ</span></a>
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