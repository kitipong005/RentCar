@extends('layouts.main') 
@section('css')
    <style>
        #overlay {   
        position: absolute;  
        top: 0px;   
        left: 0px;  
        background: #ccc;   
        width: 100%;   
        height: 100%;   
        opacity: .75;   
        filter: alpha(opacity=75);   
        -moz-opacity: .75;  
        z-index: 999;  
        background: #fff url(http://i.imgur.com/KUJoe.gif) 50% 50% no-repeat;
    }   
    </style>
@endsection
@section('contents')
<div id="overlay" hidden></div>
<div class="container">
    <form action="{{action('BookController@saveBook')}}" method="post">
        {{ csrf_field() }}
        <div class="row mt-5 border ">
            <div class="col-md-4">
                <div class="row">
                    <div class="col-md-12">
                        <img src="{{ asset('img/cars/'.$cars[0]->pic) }}" alt="" width="350px" height="350px" class="rounded-circle">
                    </div>
                </div>
                <div style="background-color:black; height:2px;"></div>
                <div class="row">
                    <h3> Pay with </h3>
                    <div class="col-md-12">
                        <input type="radio" name="" id="">&nbsp;<img src="{{asset('img/car.png')}}" alt="" width="auto;"
                            height="100%">
                    </div>
                </div>
            </div>
            <div class="col-md-8 border-left">
                @if (Auth::user())
                    @php
                        $name = Auth::user()->name;
                        $fname = substr($name,0,strpos($name,' '));
                        $lname = substr($name,strpos($name,' ')+1);
                    @endphp
                    <div class="row form-group mt-2">
                        <div class="col-md-6">
                            <input value="{{$fname}}" type="text" class="form-control" name="fname" placeholder="First Name" readonly>
                        </div>
                        <div class="col-md-6">
                            <input value="{{$lname}}" type="text" class="form-control" name="lname" placeholder="Last Name"  readonly>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col">
                            <input value="" type="text" class="form-control" name="phone" placeholder="Phone Number" required>
                        </div>
                    </div>
                @else
                {{-- no login --}}
                    <div class="row form-group mt-2">
                        <div class="col-md-6">
                            <input value="" type="text" class="form-control" name="fname" placeholder="First Name" id="fname" required>
                        </div>
                        <div class="col-md-6">
                            <input value="" type="text" class="form-control" name="lname" placeholder="Last Name" id="lname" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col">
                            <input value="" type="text" class="form-control" name="phone" placeholder="Phone Number" required>
                        </div>
                    </div>
                @endif
                <div><label for="">StartDate</label></div>
                <div class="row form-group">
                    <div class="col-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input type="text" class="form-control" name="SdateBook" id="SdateBook" autocomplete="off" required>

                        </div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-clock-o"></i></span>
                            </div>
                            <select name="StimeBook" id="StimeBook" class="form-control" value="{{old('StimeBook')}}" onchange="GetTimes();">
                                {{-- <option value="">Please Select Landmark ::</option> --}}
                                @foreach ($Stimes as $Stime)
                                    <option value="{{$Stime->id}}"  {{ old('time')== $Stime->id ? 'selected' : '' }}>{{$Stime->detail}}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                </div>
                <div><label for="">EndDate</label></div>
                <div class="row form-group">
                    <div class="col-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                            </div>
                            <input value="" type="text" class="form-control" name="EdateBook" autocomplete="off" id="EdateBook" required>
                        </div>
                    </div>
                    <div class="col-6 col-md-4">
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
                <div style="width: 100%; background-color:black; height:1px"></div>
                <br>
                <select name="landmark" id="landmark" class="form-control" value="{{old('type')}}" required>
                    <option value="">Please Select Landmark ::</option>
                    @foreach ($landmarks as $landmark)
                        <option value="{{$landmark->id}}"  {{ old('landmark')== $landmark->id ? 'selected' : '' }}>{{$landmark->nameTH}}</option>
                    @endforeach
                </select>
                <br>
                <div class="row">
                    <div class="col-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-lock fa-fw"></i></span>
                            </div>
                            @if (Auth::user())
                                <input value="{{Auth::user()->code}}" type="text" class="form-control" name="code" autocomplete="off" id="code" placeholder="select code" readonly>
                            @else
                                <input  type="text" class="form-control" name="code" autocomplete="off" id="code" placeholder="select code" maxlength="6">
                                <div class="invalid-feedback">
                                        Don't have Select Code in Database !!!
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-dollar fa-fw"></i></span>
                            </div>
                            <input type="hidden" name="" id="price" value="{{$cars[0]->price}}">
                            <input type="hidden" id="car_id" value="{{$cars[0]->id}}" name="car_id">
                            <input type="hidden" id="days" value="" name="days">
                            <input type="hidden" id="times" value="" name="times">
                            <input value="" type="text" class="form-control" name="priceAll" autocomplete="off" id="priceAll" placeholder="Pay" readonly>
                        </div>
                    </div>
                </div> 
                {{-- <input type="text" name="addr" id="addr" placeholder="Enter Address" class="form-control">
                <br>
                <div class="row">
                    <div class="col-6">
                        <input type="text" name="district" id="district" value="" placeholder="District" class="form-control">
                    </div>
                    <div class="col-6">
                        <input type="text" name="amphoe" id="amphoe" value="" placeholder="Amphoe" class="form-control">
                        <p class="text-danger">Derivery this Mueang Chiang Mai only</p>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-6">
                        <input type="text" name="province" id="province" value="" placeholder="Province" class="form-control">
                    </div>
                    <div class="col-6">
                        <input type="text" name="zipcode" id="zipcode" value="" placeholder="Zipcode" class="form-control">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-lock fa-fw"></i></span>
                            </div>
                            <input value="" type="text" class="form-control" name="code" autocomplete="off" id="EdateBook" placeholder="select code">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-dollar fa-fw"></i></span>
                            </div>
                            <input type="hidden" name="" id="price" value="{{$cars[0]->price}}">
                            <input type="hidden" id="car_id" value="{{$cars[0]->id}}" name="car_id">
                            <input value="" type="text" class="form-control" name="priceAll" autocomplete="off" id="priceAll" placeholder="Pay" readonly>
                        </div>
                    </div>
                </div> --}}
                <br>
                <div class="row">
                    <div class="col-md-12 text-right btn-paypal"><button type="submit" class="btn"><img src="{{asset('img/paypal.png')}}" alt="" height="50px" width="auto"></button></div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
 
@section('scripts')
<script src="{{asset('js/jquery.ThaiAddress.En-Th.js')}}"></script>
<script>
    var arrayDate = [];
    $(function () {
        getDateRented();
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
            database: '../js/thai_address_database_en_th.js',
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
                    $('#code').removeClass('is-valid').removeClass('is-invalid');
                }
            }
        });
    });
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
        //console.log(start)
        var times = (end - start);
        if(times > 0)
        {
            $('#times').val(times)
            console.log($('#times').val())
            return times;
        }
        else if(times <= 0)
        {
            $('#times').val(0)
            console.log($('#times').val())
            return times = 0;
        }
    }
    function CalPrice($days,$times) {
        //console.log($times);
        $price = $('#price').val();
        if($days == 0)
        {
            $('#priceAll').val($price);
        }
        else if($days > 0 && $times == 0)
        {
            $('#priceAll').val($price*$days);
        }
        else if($days > 0 && $times > 0)
        {   
            $pay_overtime = (($price/48)*$times).toFixed(2);
            //console.log(parseFloat($price*$days)+parseFloat($pay_overtime));
            $pay = parseFloat($price*$days)+parseFloat($pay_overtime);
            $('#priceAll').val($pay);
        }
    }
    //------------ get date rented this car --------
    function getDateRented()
    {
        let car_id = $('#car_id').val();
        var s_date = [];
        var e_date = [];
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ url('cars/check-rent') }}",
            method: 'post',
            data: {
                '_token': $('input[name=_token]').val(),
                'car_id': car_id
            },
            dataType: "json",
            async: false,
            success: function(result){
                if(result != '')
                {
                    $('#SdateBook').datepicker({
                        beforeShowDay: function (date) {
                        var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                        return [result.indexOf(string) == -1]},
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
                        beforeShowDay: function (date) {
                        var string = jQuery.datepicker.formatDate('yy-mm-dd', date);
                        return [result.indexOf(string) == -1]},
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
                }
                //---- end if ----
            }
        });
    }
    function checkCode(code)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        $.ajax({
                url: "{{ url('cars/book/checkcode') }}",
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
                        $('.invalid-feedback').css('display','none');
                        $('#code').removeClass('is-invalid').addClass('is-valid');
                    }
                    else 
                    {
                        $('#fname').val('').removeAttr('readonly') 
                        $('#lname').val('').removeAttr('readonly')
                        $('.invalid-feedback').css('display','block');
                        $('#code').removeClass('is-valid').addClass('is-invalid');
                        //console.log('nodata');
                    }
                    //console.log('hey');
                }
        });
    }

</script>
@endsection