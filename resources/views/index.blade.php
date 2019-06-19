@extends('layouts.main') 
@section('css')
@endsection
 
@section('header')
    @include('layouts.header')

@endsection
 
@section('contents') @if ($errors->any())
    @include('layouts.alertModal') @endif
    @if (Session::has('success'))
        <script>
            alert('กรุณารอการตรวจสอบ  !!!!');
        </script>
    @elseif (Session::has('error'))
        <script>
            alert('email นี้ท่านได้ใช้สมัครกับเว็บไซต์เราแล้ว กรุณาคลิก เข้าสู่ระบบ');
        </script>
    @endif
    @if (Session::has('admin'))
    <script>
        alert('You have not admin access');
    </script>
@endif
<div class="container mt-5">
    @include('layouts.carousel')
    <div class="row">
        <div class="col-md-12">
            <p>บริการเช่ารถจักรยานยนต์ ในเขจพื้นที่เชียงใหม่ ที่มีคุณภาพและสภาพดี มีการตรวจเช็คสภาพรถจากผู้ชำนาญ ก่อนให้บริการกับลูกค้า
            </p>
            <p> ทางบริษัทมีรถจักรยานยนต์ หลากหลายรูปแบบ และหลากหลายราคาให้เลือกใช้ พร้อมบริการหมวกนิรภัยคุณภาพเยี่ยม ได้มาตราฐาน
                มอก. ทั้งนี้สามารถเช่ารถมอเตอร์ไซต์ในเชียงใหม่ ได้ทั้งรายวันและรายเดือน </p>
            <p>เรามีบริการพิเศษคือ สามารถนำรถไปโรงแรมของท่าน หรือสถานที่ที่ท่านต้องได้ได้ฟรี ในเขตตัวเมืองเชียงใหม่ เช่น ถนนนิมมานเหมินทร์
                ส่งฟรีและรับรถมอเตอร์ไซต์ตามที่ท่านตัองการได้ โดยไม่มีค่าใช้จ่าย ยกเว้นสนามบินเชียงใหม่ ค่าบริการ 100 บาท
                ต่อครั้ง
            </p>
            <p>สอบถามข้อมูลได้ที่ 064-9587496</p>
            <p>เวลาทำการ 09.30 - 18.30</p>
        </div>
    </div>
    {{-- end row 1 --}}
    <div class="row mb-5" style="background-image:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{asset('img/พื้นหลังรถเช่าเชียงใหม่.jpg')}}')">
        <div style="width:100%" class="text-left res-pic-product">
                <img src="{{asset('img/สินค้ารถเช่า.png')}}" width="auto" height="200px;" alt="รถเช่าเชียงใหม่ เช่ารถเชียงใหม่ เช่ารถจักรยานยนต์เชียงใหม่" style="margin:2% 0 2% 2%;">
        </div>
        @foreach ($cars as $car)
            <div class="col-md-4  col-12">
                <div class="card">
                    <img src="{{asset('img/cars/'.$car->pic)}}" class="card-img-top" alt="รถเช่าเชียงใหม่ เช่ารถเชียงใหม่ เช่ารถจักรยานยนต์เชียงใหม่"
                        width="100%" height="auto">
                    <div class="card-body border">
                        <a href="tel:+66649587496" class="btn btn-primary btn-block btn-zoom"><i class="fa fa-drivers-license fa-lg"></i> >> คลิกเพื่อเช่ารถ <<</a>
                    </div>
                </div>
            </div>
        @endforeach
        {{-- <div class="col-md-4  col-12">
            <div class="card">
                <img src="{{asset('img/รถเช่าเชียงใหม่1.jpg')}}" class="card-img-top" alt="รถเช่าเชียงใหม่ เช่ารถเชียงใหม่ เช่ารถจักรยานยนต์เชียงใหม่"
                    width="100%" height="auto">
                <div class="card-body border">
                    <a href="tel:+66649587496" class="btn btn-primary btn-block"><i class="fa fa-volume-control-phone fa-lg"></i> 064-9587496</a>
                </div>
            </div>
        </div>
        <div class="col-md-4  col-12">
            <div class="card">
                <img src="{{asset('img/รถเช่าเชียงใหม่2.jpg')}}" class="card-img-top" alt="รถเช่าเชียงใหม่ เช่ารถเชียงใหม่ เช่ารถจักรยานยนต์เชียงใหม่"
                    width="100%" height="auto">
                <div class="card-body border">
                    <a href="tel:+66649587496" class="btn btn-primary btn-block"><i class="fa fa-volume-control-phone fa-lg"></i> 064-9587496</a>
                </div>
            </div>
        </div>
        <div class="col-md-4  col-12">
            <div class="card">
                <img src="{{asset('img/รถเช่าเชียงใหม่3.jpg')}}" class="card-img-top" alt="รถเช่าเชียงใหม่ เช่ารถเชียงใหม่ เช่ารถจักรยานยนต์เชียงใหม่"
                    width="100%" height="auto">
                <div class="card-body border">
                    <a href="tel:+66649587496" class="btn btn-primary btn-block"><i class="fa fa-volume-control-phone fa-lg"></i> 064-9587496</a>
                </div>
            </div>
        </div>
        <div class="w-100" style="height:20px;"></div>
        <div class="col-md-4 col-12">
            <div class="card">
                <img src="{{asset('img/รถเช่าเชียงใหม่1.jpg')}}" class="card-img-top" alt="รถเช่าเชียงใหม่ เช่ารถเชียงใหม่ เช่ารถจักรยานยนต์เชียงใหม่"
                    width="100%" height="auto">
                <div class="card-body border">
                    <a href="tel:+66649587496" class="btn btn-primary btn-block"><i class="fa fa-volume-control-phone fa-lg"></i> 064-9587496</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="card">
                <img src="{{asset('img/รถเช่าเชียงใหม่2.jpg')}}" class="card-img-top" alt="รถเช่าเชียงใหม่ เช่ารถเชียงใหม่ เช่ารถจักรยานยนต์เชียงใหม่"
                    width="100%" height="auto">
                <div class="card-body border">
                    <a href="tel:+66649587496" class="btn btn-primary btn-block"><i class="fa fa-volume-control-phone fa-lg"></i> 064-9587496</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="card">
                <img src="{{asset('img/รถเช่าเชียงใหม่3.jpg')}}" class="card-img-top" alt="รถเช่าเชียงใหม่ เช่ารถเชียงใหม่ เช่ารถจักรยานยนต์เชียงใหม่"
                    width="100%" height="auto">
                <div class="card-body border">
                    <a href="tel:+66649587496" class="btn btn-primary btn-block"><i class="fa fa-volume-control-phone fa-lg"></i> 064-9587496</a>
                </div>
            </div>
        </div> --}}
        <div class="w-100" style="height:20px;"></div>
    </div>
    {{-- end row 2 --}}
    <div class="row">
        <a href="{{action('PdfController@test')}}">cick</a>
        <div class="col-12">
            <img src="{{asset('img/travel_cnx.png')}}" alt="" width="100%" height="auto">
        </div>
    </div>
    {{-- end row travel_cnx --}} {{--
    <div class="container mt-5">
        @foreach ($attractions as $attraction)
        <div class="row mb-3">
            <div class="col-md-12" style="width:100%">
                {!! $attraction->content !!}
            </div>
        </div>
        @endforeach
    </div> --}}

    <div class="container mt-5">
        <div class="row mb-3">
            <div class="col-md-6 col-12 order-2 order-md-1 align-self-center">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-12 text-center">
                        <img src="{{asset('img/t_Wat_Phra_Tad.png')}}" alt="" width="100%" height="150px">
                        <p style="text-indent: 50px;">มาเริ่มกันที่การเดินทางไปสักการะ "พระธาตุดอยสุเทพ" ณ วัดพระธาตุดอยสุเทพราชวรวิหาร ที่มีความสำคัญในแง่ประวัติศาสตร์
                            เป็นวัดคู่บ้านคู่เมืองที่ห้ามพลาดเมื่อมาถึงจังหวัดเชียงใหม่ ภายในเป็นที่ประดิษฐานขององค์เจดีย์ทรงมอญ
                            ที่ใต้ฐานพระเจดีย์มีพระบรมสารีริกธาตุของสมเด็จพระสัมมาสัมพุทธเจ้าบรรจุอยู่ ซึ่งจัดได้ว่าเป็นปูชนียสถานที่แสดงออกถึงศิลปกรรมล้านนาไทยที่สำคัญคู่เมืองเชียงใหม่มาช้านาน
                            อีกทั้งยังเป็นพระธาตุประจำปีมะแมด้วยนอกจากนี้ยังสามารถขึ้นมาชมความงดงามขององค์เจดีย์ พร้อมกับชมทิวทัศน์โดยรอบของตัวเมืองเชียงใหม่ได้
                            โดยสามารถเดินขึ้นบันไดนาค 300 ขั้น เพื่อไปยังวัด หรือจะเลือกใช้บริการรถกระเช้าขึ้น-ลงดอยสุเทพ
                            ก็ได้ตามสะดวก
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-12 order-1 order-md-2 text-right my-auto">
                <img src="{{asset('img/WatPhraTad.jpg')}}" alt="" height="auto" width="100%" style="border-radius: 5%;">
            </div>
        </div>
        {{-- end row wat_phra_tad --}}
        <div class="row mb-3">
            <div class="col-md-6 col-12 my-auto">
                <img src="{{asset('img/Wat_Phra_Sing.png')}}" alt="" height="auto" width="100%" style="border-radius: 5%;">
            </div>
            <div class="col-md-6 col-12">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-12 text-center">
                        <img src="{{asset('img/t_Wat_Phra_Sing.png')}}" alt="" width="100%" height="150px">
                        <p style="text-indent: 50px;">วัดพระสิงห์วรมหาวิหาร จ.เชียงใหม่ เป็นที่ประดิษฐานพระพุทธสิหิงค์ พระพุทธรูปปางมารวิชัยขัดสมาธิเพชร
                            ประดิษฐานอยู่ในวิหารลายคำ เมื่อถึงเทศกาลสงกรานต์ชาวเมืองจะอัญเชิญพระพุทธรูปองค์นี้แห่ไปตามถนนรอบเมืองเพื่อให้ประชาชนสรงน้ำโดยทั่วถึงกัน
                            สถาปัตยกรรมสำคัญของวัดนี้ได้แก่ วิหารลายคำที่มีจิตรกรรมฝาผนังงดงาม พระอุโบสถ หอไตรที่มีปูนปั้นรูปเทวดาประดับ
                            และเจดีย์ทรงกลมแบบล้านนา
                        </p>
                    </div>
                </div>
            </div>
        </div>
        {{-- end row wat_phra_sing --}}
        <div class="row">
            <div class="col-md-12 col-12">
                <img src="{{asset('img/contact.png')}}" alt="ติดต่อเรา รถเช่าเชียงใหม่ เช่ารถเชียงใหม่ เช่ารถจักรยานยนต์เชียงใหม่" width="100%"
                    height="250px">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 col-12 text-center" style="display:block">
                <div class="icon-bar mt-5">
                    <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                    <a href="#" class="google"><i class="fa fa-google"></i></a>
                    <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
                    <a href="#" class="youtube"><i class="fa fa-youtube"></i></a>
                </div>
                <img src="{{asset('img/map.png')}}" alt="แผนที่ รถเช่าเชียงใหม่ เช่ารถเชียงใหม่ เช่ารถจักรยานยนต์เชียงใหม่" width="100%"
                    height="550px" id="map">
            </div>
        </div>
    </div>
</div>
    @include('layouts.regisModal')
    @include('layouts.Login')
@endsection
 
@section('footer')
    @include('layouts.contact')
@endsection


@section('scripts')
<script>

</script>
@endsection