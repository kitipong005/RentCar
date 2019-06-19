@extends('layouts.main') 
@section('header')
    @include('layouts.navbar') 
@endsection
 
@section('contents')
<div class="container mt"> 
    <div class="row">
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
                        <div class="col-md-4 col-12 mb-2"><input type="radio" name="bank" value="ธนาคารไทยพาณิชย์" id="bank" required>&nbsp;<img src="{{ asset('img/scb.jpg') }}"
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
            <br> {{-- start date payment --}}
            <div class="row">
                <div class="col-md-2">วันที่ชำระเงิน :</div>
                <div class="col-md-4">
                    <input type="text" name="date_pay" id="date_pay" class="form-control" required>
                </div>
            </div>
            {{-- end date payment --}}
            <br> {{-- start time payment --}}
            <div class="row">
                <div class="col-md-2">เวลา :</div>
                <div class="col-md-4">
                    <input type="time" name="time_pay" id="time_pay" class="form-control" required>
                </div>
            </div>
            {{-- end time payment --}}
            <br> {{-- start price payment --}}
            <div class="row">
                <div class="col-md-2">จำนวนเงิน :</div>
                <div class="col-md-4">
                    <input type="text" name="price" id="price" class="form-control" placeholder="0.00" required>
                </div>
                Bath
            </div>
            {{-- end price payment --}}
            <br> {{-- start pic payment --}}
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
            <br> {{-- start No cart --}} {{--
            <table class="table text-center">
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
                    <input type="text" name="code" id="code" class="form-control" required>
                </div>
            </div>
            {{-- end No cart --}}
            <br>
            <div class="w-100 border"></div>
            <br>
            <div>
                <input type="hidden" name="book_id" id="book_id">
                <button type="submit" class="btn btn-primary btn-block">แจ้งการชำระเงิน</button>
            </div>
        </form>
    </div>
    {{-- end row 1 --}}
    <br>
    <br>
</div>
@endsection
@section('scripts')
    <script>
        $(document).on('keyup','#code',function(){
            var code = $('#code').val();
            var countTxtNull=0;
            var countTxt=0;
            try
            {
                countTxtNull=code.match(/\s/g).length;
            }
            catch(e)
            {
                countTxt=code.length-countTxtNull;
                if(countTxt > 5)
                {
                    checkCode(code)
                    //console.log('getdata')
                }
                else 
                {
                    $('#code').removeClass('is-valid').removeClass('is-invalid');
                    //$('#code').removeClass('is-valid').addClass('is-invalid');
                }
            }
        });
        function checkCode(code)
        {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                    url: "{{ action('PaymentController@checkCodeBook') }}",
                    method: 'get',
                    data: {
                        // '_token': $('input[name=_token]').val(),
                        'code' : code
                    },
                    dataType: "json",
                    async: false,
                    beforeSend: function(){
                        $('#overlay').fadeOut();
                    },
                    success: function(result){
                        //console.log(result.length);
                        if(result.length > 0)
                        {
                            $('#book_id').val(result[0].id);
                            $('.invalid-feedback').css('display','none');
                            $('#code').removeClass('is-invalid').addClass('is-valid');
                        }
                        else 
                        {
                            $('#book_id').val('');
                            $('.invalid-feedback').css('display','block');
                            $('#code').removeClass('is-valid').addClass('is-invalid');
                        }
                        //console.log('hey');
                    }
            });
        }
        $('#date_pay').datepicker({
            dateFormat: 'yy-mm-dd'
        });
    </script>
@endsection