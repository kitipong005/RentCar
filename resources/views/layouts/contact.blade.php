<div class="row justify-content-center mb-1 mt-md-5 contact" style="background-color:#B2D732">
    <div class="col-10 mb-3">
        @if (Session::get('language') == 'en')
        <div class="row">
                <div class="col-12 col-md-5 mt-2 border-left">
                    <div class="border-bottom">
                        <strong style="color:DarkOrange">Menu</strong>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-6">
                            Home
                        </div>
                        <div class="col-4">
                            
                        </div>
                        <div class="col-4">
                            
                        </div>
                    </div>
                </div>
                <div class="col border-left ">
                    <div class="mt-2">
                        <div class="border-bottom">
                            <strong style="color:DarkOrange;">Contact Me</strong>
                        </div>
                        <p>224/5 ถนนมหิดล ตำบลป่าแดด อำเภอเมือง จังหวัดเชียงใหม่ 50100</p>
                        <strong style="color:DarkOrange">rent_Car@gmail.com</strong>
                        <br>
                        {{-- <strong style="color:DarkOrange">0999999999</strong> --}}
                    </div>
                </div>
            </div>
        @else
        <div class="row">
                <div class="col-md-4 border-left">
                    <div style="border-bottom: 5px solid gray;">
                        <strong style="color:DarkOrange">สถิติการเข้าชมเว็บไซต์</strong>
                    </div>
                    <br>
                    <table class="table table-bordered">
                    <thead class="text-center">
                        <tr>
                        <th scope="col" colspan="2">สถิติ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        @php
                            $today = \App\Counter::where('DATE','=',Carbon\Carbon::now()->toDateString())->count();
                        @endphp
                        <td style="width:50%">วันนี้</td>
                        <td>{{$today}}</td>
                        </tr>
                        <tr>
                            @php
                                $yesterday = \App\Daily::select('NUM')->where('DATE','=',Carbon\Carbon::now()->subDay()->toDateString())->first();
                            @endphp
                            <td style="width:50%">เมื่อวานนี้</td>
                            @if ($yesterday == null)
                            <td>0</td>
                            @else
                            <td>{{$yesterday->NUM}}</td>
                            @endif
                        </tr>
                        <tr>
                            @php
                                $thismonth = \App\Daily::where(\DB::raw("(DATE_FORMAT(DATE,'%Y-%m'))"),Carbon\Carbon::now()->format('Y-m'))->sum('NUM');
                            @endphp
                            <td style="width:50%">เดือนนี้</td>
                            <td>{{$thismonth}}</td>
                        </tr>
                        <tr>
                            @php
                                $lastmonth = \App\Daily::where(\DB::raw("(DATE_FORMAT(DATE,'%Y-%m'))"),Carbon\Carbon::now()->subMonth()->format('Y-m'))->sum('NUM');
                            @endphp
                            <td style="width:50%">เดือนที่แล้ว</td>
                            <td>{{$lastmonth}}</td>
                        </tr>
                        <tr>
                            @php
                                $thisyear = \App\Daily::where(\DB::raw("(DATE_FORMAT(DATE,'%Y'))"),Carbon\Carbon::now()->format('Y'))->sum('NUM');
                            @endphp
                            <td style="width:50%">ปีนี้</td>
                            <td>{{$thisyear}}</td>
                        </tr>
                        <tr>
                            @php
                                $lastyear = \App\Daily::where(\DB::raw("(DATE_FORMAT(DATE,'%Y'))"),Carbon\Carbon::now()->subYear()->format('Y'))->sum('NUM');
                            @endphp
                            <td style="width:50%">ปีที่แล้ว</td>
                            <td>{{$lastyear}}</td>
                        </tr>
                    </tbody>
                    </table>
                </div>
                <div class="col-md-3 border-left" id="contact">
                    <div style="border-bottom: 5px solid gray;">
                        <strong style="color:DarkOrange">Menu</strong>
                    </div>
                    <br>
                    <a href="{{action('IndexController@index')}}" role="button">หน้าหลัก</a>
                    <div style="height:1px; background-color:white"></div>
                    <a href="#" data-toggle="modal" data-target="#RegisModal" role="button">สมัครสมาชิก</a>
                    <div style="height:1px; background-color:white"></div>
                    <a href="#" data-toggle="modal" data-target="#LoginModal" role="button" >เข้าสู่ระบบ</a>
                    <div style="height:1px; background-color:white"></div>
                    <a href="{{action('CarController@carshowform')}}" role="button">สินค้า</a>
                    <div style="height:1px; background-color:white"></div>
                    <a href="{{action('PaymentController@howtopayment')}}" role="button">แจ้งชำระเงิน</a>
                    <div style="height:1px; background-color:white"></div>
                    <a href="{{action('IndexController@howto')}}" role="button">วิธีการสั่งซื้อสินค้า</a>
                    <div style="height:1px; background-color:white"></div>
                    <a href="#" role="button">สถานที่สำคัญของเชียงใหม่</a>
                    <div style="height:1px; background-color:white"></div>
                </div>
                <div class="col-md-5 border-left ">
                    <div class="mt-2">
                        <div style="border-bottom: 5px solid gray;">
                            <strong style="color:DarkOrange;">ติดต่อเรา</strong>
                        </div>
                        <br>
                        <p>223/5 ถนนมหิดล ตำบลป่าแดด อำเภอเมือง จังหวัดเชียงใหม่ 50100</p>
                        <strong style="color:DarkOrange">โทร 064-9587496</strong>
                        {{-- <strong style="color:DarkOrange">0999999999</strong> --}}
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>