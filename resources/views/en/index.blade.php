@extends('layouts.main') 
@section('header')
<nav>
    @include('layouts.header')
</nav>
@endsection
 
@section('contents') @if ($errors->any())
    @include('layouts.alertModal') @endif
<div class="container mt-5">
    <div class="row mb-5">
        <div class="col-md-4 col-12">
            <div class="card">
                <img src="{{asset('img/car1.jpg')}}" class="card-img-top" alt="..." width="100%" height="auto">
                <div class="card-body border">
                    <a href="tel:+66649587496" class="btn btn-primary btn-block"><i class="fa fa-volume-control-phone fa-lg"></i> 064-9587496</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="card">
                <img src="{{asset('img/car2.jpg')}}" class="card-img-top" alt="..." width="100%" height="auto">
                <div class="card-body border">
                    <a href="tel:+66649587496" class="btn btn-primary btn-block"><i class="fa fa-volume-control-phone fa-lg"></i> 064-9587496</a>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-12">
            <div class="card">
                <img src="{{asset('img/car3.jpg')}}" class="card-img-top" alt="..." width="100%" height="auto">
                <div class="card-body border">
                    <a href="tel:+66649587496" class="btn btn-primary btn-block"><i class="fa fa-volume-control-phone fa-lg"></i> 064-9587496</a>
                </div>
            </div>
        </div>
    </div>
    {{-- end row 1 --}}
</div>
Hello world
<div class="row">
    <div class="col-12">
        <img src="{{asset('img/travel_cnx.png')}}" alt="" width="100%" height="auto">
    </div>
</div>
{{-- end row travel_cnx --}}
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
                        โดยสามารถเดินขึ้นบันไดนาค 300 ขั้น เพื่อไปยังวัด หรือจะเลือกใช้บริการรถกระเช้าขึ้น-ลงดอยสุเทพ ก็ได้ตามสะดวก
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12 order-1 order-md-2 text-right my-auto">
            <img src="{{asset('img/pratad.jpg')}}" alt="" height="auto" width="100%" style="border-radius: 5%;">
        </div>
    </div>
    {{-- end row wat_phra_tad --}}
    <div class="row mb-3">
        <div class="col-md-6 col-12 my-auto">
            <img src="{{asset('img/Wat_Phra_Sing.jpg')}}" alt="" height="auto" width="100%" style="border-radius: 5%;">
        </div>
        <div class="col-md-6 col-12">
            <div class="row justify-content-center">
                <div class="col-md-8 col-12 text-center">
                    <img src="{{asset('img/t_Wat_Phra_Sing.png')}}" alt="" width="100%" height="150px">
                    <p style="text-indent: 50px;">วัดพระสิงห์วรมหาวิหาร จ.เชียงใหม่ เป็นที่ประดิษฐานพระพุทธสิหิงค์ พระพุทธรูปปางมารวิชัยขัดสมาธิเพชร ประดิษฐานอยู่ในวิหารลายคำ
                        เมื่อถึงเทศกาลสงกรานต์ชาวเมืองจะอัญเชิญพระพุทธรูปองค์นี้แห่ไปตามถนนรอบเมืองเพื่อให้ประชาชนสรงน้ำโดยทั่วถึงกัน
                        สถาปัตยกรรมสำคัญของวัดนี้ได้แก่ วิหารลายคำที่มีจิตรกรรมฝาผนังงดงาม พระอุโบสถ หอไตรที่มีปูนปั้นรูปเทวดาประดับ
                        และเจดีย์ทรงกลมแบบล้านนา
                    </p>
                </div>
            </div>
        </div>
    </div>
    {{-- end row wat_phra_sing --}}
    <div class="row">
        <img src="{{asset('img/contact.png')}}" alt="" width="100%" height="250px">
        <div class="col-md-12 col-12">
            <img src="{{asset('img/map.png')}}" alt="" width="100%" height="550px" id="map">
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