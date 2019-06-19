@extends('layouts.main') 
@section('css')
<link rel="stylesheet" href="{{asset('css/timeline.css')}}">
@endsection
 
@section('contents')
<div class="container mt-5" style="background-color:white; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); border-radius: 25px;">
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
                            <div class="timeline-badge warning"><i class="fa fa-motorcycle"></i></div>
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
                            <div class="timeline-badge"><i class="fa fa-motorcycle"></i></div>
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
        {{-- end timeline --}} {{-- start detail book --}}
    <table class="table text-center">
        <thead class="thead-dark">
            <tr>
                <th scope="col">แจ้งชำระเงิน</th>
            </tr>
        </thead>
    </table>
    {{-- start bank list --}}
    <h4>รายละเอียดการโอนเงิน</h4>
    <div class="w-100 border my-3"></div>
    <form action="{{action('BookController@savepayment')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-2 col-12 mb-2">บัญชีที่โอนเงิน :</div>
        <div class="col-md-10 col-12"> 
            <div class="row">
                <div class="col-md-4 col-12 mb-2"><input type="radio" name="bank" value = "ธนาคารไทยพาณิชย์" id="bank" required>&nbsp;<img src="{{ asset('img/scb.jpg') }}"
                    alt="IMG" style="width:120px; height:64px;">&nbsp;&nbsp;<img src="{{ asset('img/scb-1.png') }}"
                    alt="IMG" style="width:128px; height:64px;"></div>
                <div class="col-md-4 col-12 mb-2"><input type="radio" name="bank" value="ธนาคารกสิกรไทย" id="bank">&nbsp;<img src="{{ asset('img/kb.jpg') }}"
                    alt="IMG" style="width:120px; height:64px;">&nbsp;&nbsp;<img src="{{ asset('img/kb-1.png') }}"
                    alt="IMG" style="width:128px; height:64px;"></div>
                <div class="col-md-4 col-12 mb-2"><input type="radio" name="bank" value="ธนาคารกรุงศรี" id="bank">&nbsp;<img src="{{ asset('img/ksb.png') }}"
                    alt="IMG" style="width:120px; height:64px;">&nbsp;&nbsp;<img src="{{ asset('img/ksb-1.png') }}"
                    alt="IMG" style="width:128px; height:64px;"></div>
            </div>
            <div class="row">
                <div class="col-md-4 col-12 mb-2"><input type="radio" name="bank" value="ธนาคารกรุงเทพ" id="bank">&nbsp;<img src="{{ asset('img/bkk.jpg') }}"
                    alt="IMG" style="width:120px; height:64px;">&nbsp;&nbsp;<img src="{{ asset('img/bkk-1.png') }}"
                    alt="IMG" style="width:128px; height:64px;"></div>
                <div class="col-md-4 col-12 mb-2"><input type="radio" name="bank" value="ธนาคารออมสิน" id="bank">&nbsp;<img src="{{ asset('img/gsb.jpg') }}"
                    alt="IMG" style="width:120px; height:64px;">&nbsp;&nbsp;<img src="{{ asset('img/gsb-1.png') }}"
                    alt="IMG" style="width:128px; height:64px;"></div>
            </div>                                   
        </div>
    </div>
    {{-- end bank list --}}
    <br>
    {{-- start date payment --}}
    <div class="row">
        <div class="col-md-2">วันที่ชำระเงิน :</div>
        <div class="col-md-4">
            <input type="text" name="date_pay" id="date_pay" class="form-control" required>
        </div>
    </div>
    {{-- end date payment --}}
    <br>
    {{-- start time payment --}}
    <div class="row">
        <div class="col-md-2">เวลา :</div>
        <div class="col-md-4">
            <input type="time" name="time_pay" id="time_pay" class="form-control" required>
        </div>
    </div>
    {{-- end time payment --}}
    <br>
    {{-- start price payment --}}
    <div class="row">
        <div class="col-md-2">จำนวนเงิน :</div>
        <div class="col-md-4">
            <input type="text" name="price" id="price" class="form-control" placeholder="0.00" required>
        </div>
        <div class="col-md-2">Bath</div>
    </div>
    {{-- end price payment --}}
    <br>
    {{-- start pic payment --}}
    <div class="row">
        <div class="col-md-2 col-12">หลักฐานการโอน :</div>
        <div class="col-md-4 col-12">
            <input type="file" name="pic" id="pic" class="form-control">
        </div>
        <p style="color:red">***** ไฟร์ต้องมีขนาดไม่เกิน 2M</p>
    </div>
    {{-- end pic payment --}}
    <br>
    <div class="w-100 border"></div>
    <br>
    {{-- start No cart --}}
    {{-- <table class="table text-center">
        <thead class="thead-dark">
            <tr>
                <th scope="col">กรอกเลขที่การสั่งซื้อ</th>
            </tr>
        </thead>
    </table> --}}
    <h4>กรอกเลขที่การสั่งซื้อ</h4>
    <div class="w-100 border my-3"></div>
    <div class="row justify-content-md-center">
        <div class="col-md-2">
            เลขที่ใบสั่งซื้อ :
        </div>
        <div class="col-md-4">
            <input type="text" name="code" id="code" class="form-control" value="{{$book->code}}" readonly required>
        </div>
    </div>
    {{-- end No cart --}}
    <br>
    <div class="w-100 border"></div>
    <br>
    <div>
        <input type="hidden" name="book_id" value="{{$book->id}}">
        <button type="submit" class="btn btn-primary btn-block">แจ้งการชำระเงิน</button>
    </div>
    </form>
    <br>
</div>
{{-- end detail book --}}
@endsection
@section('scripts')
    <script>
        $('#date_pay').datepicker({
            dateFormat: 'yy-mm-dd'
        });
    </script>
@endsection