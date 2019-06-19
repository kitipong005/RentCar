@extends('layouts.main') 
@section('css')
<link rel="stylesheet" href="{{asset('css/timeline.css')}}">
<style>
    .scroll {
        max-height: 15em;
        overflow-y: auto;
    }

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
    {{-- start timeline --}}
    <div class="row">
        <div class="col-md-12 col-12">
            <div class="page-header">
                <img src="{{asset('img/slogan.png')}}" alt="" width="auto" height="260px">
            </div>
            <div style="display:inline-block;width:100%;overflow-y:auto;">
                <ul class="timeline timeline-horizontal">
                    <li class="timeline-item">
                        <div class="timeline-badge primary"><i class="fa fa-motorcycle"></i></div>
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
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">รายการสินค้า</th>
            </tr>
        </thead>
    </table>
    <form action="{{action('BookController@saveBook')}}" method="post">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-3 col-12">
            <img src="{{asset('img/cars/'.$cars->pic)}}" alt="" width="250px" height="100%" class="rounded border border-dark">
        </div>
        <div class="col-md-9">
            {{-- start rent car --}}
            <div class="row form-group">
                <label for="" class="col-sm-2 col-form-label">วันที่เริ่มเช่ารถ: </label>
                <div class="col-md-4 col-12 mb-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                        <input type="text" class="form-control" name="SdateBook" id="SdateBook" autocomplete="off" required>

                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                        </div>
                        <select name="StimeBook" id="StimeBook" class="form-control" value="{{old('StimeBook')}}" onchange="GetTimes();">
                                {{-- <option value="">Please Select Landmark ::</option> --}}
                                @foreach ($Stimes as $Stime)
                                    <option value="{{$Stime->id}}"  {{ old('StimeBook')== $Stime->id ? 'selected' : '' }}>{{$Stime->detail}}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
            </div>
            {{-- end rent car --}} {{-- start return car --}}
            <div class="row form-group">
                <label for="" class="col-sm-2 col-form-label">วันที่ส่งคืนรถ: </label>
                <div class="col-md-4 col-12 mb-2">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                        </div>
                        <input type="text" class="form-control" name="EdateBook" id="EdateBook" autocomplete="off" required>

                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                        </div>
                        <select name="EtimeBook" id="EtimeBook" class="form-control" value="{{old('EtimeBook')}}" onchange="GetTimes();">
                                    {{-- <option value="">Please Select Landmark ::</option> --}}
                                    @foreach ($Etimes as $Etime)
                                        <option value="{{$Etime->id}}"  {{ old('EtimeBook')== $Etime->id ? 'selected' : '' }}>{{$Etime->detail}}</option>
                                    @endforeach
                            </select>
                    </div>
                </div>
            </div>
            {{-- end return car --}} {{-- start cal price --}}
            <div class="row form-group">
                <label for="" class="col-sm-2 col-form-label">ราคารถ/วัน: </label>
                <div class="col-md-4">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa-fw fa fa-dollar"></i></span>
                        </div>
                        <input type="text" class="form-control" name="price" id="price" autocomplete="off" value="{{$cars->price}}" readonly>
                    </div>
                </div>
                <label for="" class="col-sm-2 col-form-label">Bath</label>
            </div>
            <div class="row form-group">
                <label for="" class="col-sm-2 col-form-label">ราคารวม: </label>
                <div class="col-md-4">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa-fw fa fa-money"></i></span>
                        </div>
                        <input type="text" class="form-control" name="priceAll" id="priceAll" autocomplete="off" value="0" readonly>
                    </div>
                </div>
                <label for="" class="col-sm-2 col-form-label">Bath</label>
            </div>
            {{-- end cal price --}}
        </div>
    </div>
    <br> {{-- end row detail car --}}
    <div class="w-100" style="height:1px; background-color:gray"></div>
    <br> {{-- strat row address --}}
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ชื่อและที่อยู่การจัดส่ง</th>
            </tr>
        </thead>
    </table>
    <h5>ข้อมูลผู้รับรถ</h5>
    <div class="row">
        {{-- start col address --}}
        <div class="col-md-6 mb-5 rounded">
            <div class="row form-group mt-2">
                <div class="col-md-12">
                    <input value="" type="text" class="form-control" name="fname" placeholder="First Name" id="fname" required readonly>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-12">
                    <input value="" type="text" class="form-control" name="lname" placeholder="Last Name" id="lname" required readonly>
                </div>
            </div>
            <div class="row form-group">
                <div class="col">
                    <input value="" type="email" class="form-control" name="email" placeholder="E-mail" id="email" required readonly>
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-4">
                    <select name="phone_id" id="phone_id" class="form-control" required disabled>
                            <option value="">เลือกประเทศ</option>
                        @foreach ($phone as $ph)
                            <option value="{{$ph->code}}">{{$ph->th}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-8">
                        <div class="input-group mb-2">
                            <div class="input-group-prepend" id="phone_code">
                                {{-- <div class="input-group-text"></div> --}}
                            </div>
                            <input type="text" class="form-control" name="phone" placeholder="Phone Number" id="phone" required readonly>
                        </div>
                        {{-- <input value="" type="text" class="form-control" name="phone" placeholder="Phone Number" id="phone" required readonly> --}}
                </div>
            </div>
            <div class="w-100 mb-2" style="height:1px; background-color:gray"></div>
            <h5>ที่อยู่ที่ต้องการให้ส่งรถ</h5>
            <div class="row form-group">
                <div class="col-md-12">
                    <select name="landmark" id="landmark" class="form-control" value="{{old('type')}}" required disabled>
                        <option value="">Please Select Landmark ::</option>
                        @foreach ($landmarks as $landmark)
                            <option value="{{$landmark->id}}"  {{ old('landmark')== $landmark->id ? 'selected' : '' }}>{{$landmark->nameTH}}</option>
                        @endforeach
                    </select>
                    <input type="hidden" name="priceTranspot" id="priceTranspot" value="0">
                </div>
                <div class="col-md-12" id="priceLandmark">
                    
                </div>
            </div>
            <div class="w-100 mb-2" style="height:1px; background-color:gray"></div>
            <h5>รหัสลับ (กรณีไม่ต้องการเข้าสู่ระบบ)</h5>
            <div class="row form-group">
                <div class="col-md-12">
                    <input type="text" class="form-control" name="code" autocomplete="off" id="code" placeholder="select code" maxlength="6" readonly>
                    <div class="invalid-feedback">
                        Don't have Select Code in Database !!!
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-12 mb-2">
                    <input type="hidden" id="days" value="" name="days">
                    <input type="hidden" id="times" value="" name="times">
                    <input type="hidden" id="car_id" value="{{$cars->id}}" name="car_id">
                    <button type="submit" class="btn btn-primary btn-block button"><span>เช่ารถ</span></button>
                </div>
                <div class="col-md-6 col-12">
                    <button type="button" class="btn btn-danger btn-block button" onclick="return window.location.href='/รถเช่า'"><span>ย้อนกลับ</span></button>
                </div>
            </div>
        </div>
        {{-- end col address --}} {{-- start col Terms & Privacy --}}
        <div class="col-md-6 rounded">
            <div class="card text-white bg-danger mb-3" style="max-width: 100%;">
                <div class="card-header text-center">Terms & Privacy</div>
                <div class="card-body" style="height:20em;">
                    <h5 class="card-title">โปรดอ่านเพื่อประโยชน์ต่อตัวท่านเอง</h5>
                    <p class="card-text scroll">
                        บริการส่งรถเช่าให้ถึงที่ฟรีในเขตตัวเมืองเชียงใหม่ ห้วยแก้ว ถนนนิมมานเหมินทร์ ส่งฟรีและรับรถมอเตอร์ไซต์ ตามที่ท่านต้องการได้โดยไม่หักค่าใช้จ่าย
                        ยก เว้นสนามบินเชียงใหม่และต่างอำเภอจะคิดค่าบริการ 100 บาทต่อครั้งหรือมากกว่า ตามระยะทางสถานที่ ที่ท่านต้องการให้เราส่งรถเช่า
                        <h5 style="color:yellow">เอกสารประกอบการเช่ารถ</h5> 
                        <ol>
                            <li>บัตรประชาชน/ใบขับขี่</li>
                            <li>เงินค่าเช่ารถ</li>
                            <li>บัตรประชาชนตัวจริง(สำหรับคนไทย)</li>
                            <li>มัดจำขั้นต่ำ 4000 บาท</li>
                        </ol>
                    </p>
                </div>
                <div class="card-footer">
                    <label>
                        <input type="checkbox" name="agree" id="agree"> กดยอมรับเงื่อนไขเพื่อทำการเช่ารถ
                    </label>
                </div>
            </div>
        </div>
        {{-- end col Terms & Privacy --}}
    </div>
    {{-- end row address --}}
</form>
<br>
<br>
</div>
{{-- end detail book --}}
@endsection
 
@section('scripts')
<script src="{{asset('js/jquery.ThaiAddress.En-Th.js')}}"></script>
<script>
    var arrayDate = [];
    $(function () {
        //getDateRented();
        $N_date = 0;
        $N_time = 0;
        //----- datepicker ----
        $('#SdateBook').datepicker({
            autoOpen: false,
            dateFormat: 'yy-mm-dd',
            minDate: 0,
            changeMonth: true,
            changeYear: true,
            onSelect: function (selected) {
                $('#EdateBook').datepicker(
                    'option',
                    'minDate',
                    $('#SdateBook').val()
                );
                $('#SdateBook').val();
                $days = GetDays();
                $times = GetTimes();
                CalPrice( $days, $times);
                // $N_date = GetDays();
                // console.log($N_date);
            }
        });
        $('#EdateBook').datepicker({
            autoOpen: false,
            dateFormat: 'yy-mm-dd',
            minDate: 0,
            changeMonth: true,
            changeYear: true,
            onSelect: function (selected) {
                $('#SdateBook').datepicker(
                    'option',
                    'maxDate',
                    $('#EdateBook').val()
                );
                $('#EdateBook').val();
                $days = GetDays();
                $times = GetTimes();
                CalPrice( $days, $times);
                //$N_date = GetDays();
                //console.log($N_date);
            }
        });
        //--- address ------
        $.ThaiAddressEnTh({
            lang: 'EN',
            database: '../../js/thai_address_database_en_th.js',
            district: $('#district'),
            amphoe: $('#amphoe'),
            province: $('#province'),
            zipcode: $('#zipcode')
        });
        //----- get time to change select ------
        $('#StimeBook').change(function(){
            $days = GetDays();
            $times = GetTimes();
            CalPrice( $days, $times);
            
        });
        $('#EtimeBook').change(function(){
            $days = GetDays();
            $times = GetTimes();
            CalPrice( $days, $times);
        });

        //------- get name in select code -----
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
                    // console.log('getdata')
                }
                else 
                {
                    $('#fname').val('').removeAttr('readonly') 
                    $('#lname').val('').removeAttr('readonly')
                    $('#email').val('').removeAttr('readonly')
                    $('#phone').val('').removeAttr('readonly')
                    $('#phone_id').val('').removeAttr('disabled')
                    $('#phone_code').children().remove();
                    $('#code').removeClass('is-valid').removeClass('is-invalid');
                    //$('#code').removeClass('is-valid').addClass('is-invalid');
                }
            }
        });
        //----- checked agree Terms & Privacy ----
        $('#agree').click(function(){
            if($(this).prop('checked') == true)
            {
                $('#fname').removeAttr('readonly');
                $('#lname').removeAttr('readonly');
                $('#phone').removeAttr('readonly');
                $('#code').removeAttr('readonly');
                $('#email').removeAttr('readonly');
                $('#landmark').removeAttr('disabled');
                $('#phone_id').val('').removeAttr('disabled')
            }
            else
            {
                $('#fname').val('')
                $('#lname').val('')
                $('#phone').val('')
                $('#fname').attr('readonly','true');
                $('#lname').attr('readonly','true');
                $('#phone').attr('readonly','true');
                $('#code').attr('readonly','true');
                $('#email').val('').attr('readonly','true');
                $('#phone_id').val('').attr('disabled','true');
                $('#phone_code').children().remove();
                $('#landmark').attr('disabled','true').val('');
                $('#priceLandmark').empty();
                $('#priceTranspot').val(0);
                $('#priceAll').val(0);
            }
        });
    });
    //---------- get phone_id if select --------
    $('#phone_id').change(function(){
        var code = $(this).children("option:selected").val();
        $('#phone_code').html('<div class="input-group-text">+'+code+'</div>')
    });
    //---------- get price in select landmark ----------
    $('#landmark').change(function(){
        var landmarkID = $(this).children("option:selected").val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ action('BookController@getPriceLandmark') }}",
            method: 'get',
            data: {
                'id':landmarkID
            },
            dataType: "json",
            async: false,
            success: function(data){
                $('#priceLandmark').empty();
                if(data.priceTranspot > 0)
                {
                    $('#priceLandmark').append('<p style="color:red">******** สถานที่นี้มีค่าบริการส่ง '+data.priceTranspot+' บาท *********</p>')
                }
                else
                {
                    $('#priceLandmark').append('<p style="color:red">******** สถานที่นี้บริการส่งฟรี **********</p>')
                } 
                $('#priceTranspot').val(data.priceTranspot);
                $days = GetDays();
                $times = GetTimes();
                CalPrice( $days, $times);
            }
        });
    })
    //---------- end --------------------
    //--- get days -----
    function GetDays() {
        var start = $('#SdateBook').datepicker('getDate');
        var end = $('#EdateBook').datepicker('getDate');
        if (start != null && end != null) {
            var days = (end - start) / 1000 / 60 / 60 / 24;
            if(days == 0)
            {
                $('#days').val(1)
                // console.log($('#days').val())
                return days;
            }
            else if(days > 0)
            {
                $('#days').val(days)
                // console.log($('#days').val())
                return days;
            }
            
        }
        $('#days').val(0)
        // console.log($('#days').val())
        return days = 0;
    }
    // get time ----------
    function GetTimes() {
        var start = $('#StimeBook').val();
        var end = $('#EtimeBook').val();
        var times = ((end - start)*30)/60;
        console.log(times)
        if(times > 0)
        {
            $('#times').val(times)
            //console.log($('#times').val())
            return times;
        }
        else if(times <= 0)
        {
            $('#times').val(0)
            //console.log($('#times').val())
            return times = 0;
        }
    }
    function CalPrice($days,$times) {
        var priceTranspot = $('#priceTranspot').val();
        console.log(priceTranspot)
        $price = $('#price').val();

        if($days == 0)
        {
            $pay = parseFloat($price)+parseFloat(priceTranspot);
            $('#priceAll').val($pay);
        }
        else if($days > 0 && $times == 0)
        {
            $pay = parseFloat($price*$days)+parseFloat(priceTranspot);
            $('#priceAll').val($pay);
        }
        else if($days > 0 && $times > 0)
        {   
            $pay_overtime = (($price/48)*$times).toFixed(2);
            //console.log(parseFloat($price*$days)+parseFloat($pay_overtime));
            $pay = parseFloat($price*$days)+parseFloat($pay_overtime)+parseFloat(priceTranspot);
            $('#priceAll').val($pay);
        }
    }
    //------------ get date rented this car --------
    // function getDateRented()
    // {
    //     let car_id = $('#car_id').val();
    //     var s_date = [];
    //     var e_date = [];
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    //         }
    //     });
    //     $.ajax({
    //         url: "{{ action('CarController@carcheckrent') }}",
    //         method: 'post',
    //         data: {
    //             '_token': $('input[name=_token]').val(),
    //             'car_id': car_id
    //         },
    //         dataType: "json",
    //         async: false,
    //         success: function(result){
    //             if(result != '')
    //             {
    //                 $('#SdateBook').datepicker({
    //                     beforeShowDay: function (date) {
    //                     var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
    //                     return [result.indexOf(string) == -1]},
    //                     autoOpen: false,
    //                     dateFormat: 'yy-mm-dd',
    //                     minDate: 0,
    //                     changeMonth: true,
    //                     changeYear: true,
    //                     onSelect: function (selected) {
    //                         $('#EdateBook').datepicker(
    //                             'option',
    //                             'minDate',
    //                             $('#SdateBook').val()
    //                         );
    //                         $('#SdateBook').val();
    //                         $days = GetDays();
    //                         $times = GetTimes();
    //                         CalPrice( $days, $times);
    //                         // $N_date = GetDays();
    //                         // console.log($N_date);
    //                     }
    //                 });
    //                 $('#EdateBook').datepicker({
    //                     beforeShowDay: function (date) {
    //                     var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
    //                     return [result.indexOf(string) == -1]},
    //                     autoOpen: false,
    //                     dateFormat: 'yy-mm-dd',
    //                     minDate: 0,
    //                     changeMonth: true,
    //                     changeYear: true,
    //                     onSelect: function (selected) {
    //                         $('#SdateBook').datepicker(
    //                             'option',
    //                             'maxDate',
    //                             $('#EdateBook').val()
    //                         );
    //                         $('#EdateBook').val();
    //                         $days = GetDays();
    //                         $times = GetTimes();
    //                         CalPrice( $days, $times);
    //                         //$N_date = GetDays();
    //                         //console.log($N_date);
    //                     }
    //                 });
    //             }
    //             //---- end if ----
    //         }
    //     });
    // }
    function checkCode(code)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
                url: "{{ action('BookController@checkCode') }}",
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
                    console.log(result.length);
                    if(result.length > 0)
                    {
                        var name = result[0].name;
                        var fname = name.substr(0,name.indexOf(' '));
                        var lname = name.substr(name.indexOf(' ')+1);
                        $('#fname').val(fname).attr('readonly','true');
                        $('#lname').val(lname).attr('readonly','true');
                        $('#email').val(result[0].email).attr('readonly','true');
                        $('#phone').removeAttr('readonly');
                        $('#phone_id').removeAttr('disabled');
                        $('.invalid-feedback').css('display','none');
                        $('#code').removeClass('is-invalid').addClass('is-valid');
                    }
                    else 
                    {
                        $('#fname').val('').removeAttr('readonly') 
                        $('#lname').val('').removeAttr('readonly')
                        $('.invalid-feedback').css('display','block');
                        $('#code').removeClass('is-valid').addClass('is-invalid');
                        $('#phone').val('').removeAttr('readonly');
                        $('#phone_id').val('').removeAttr('disabled')
                        $('#phone_code').children().remove();
                        $('#email').val('').removeAttr('readonly');
                        //console.log('nodata');
                    }
                    //console.log('hey');
                }
        });
    }

</script>
@endsection