<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>รถเช่าเชียงใหม่</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/me.css')}}">
    <link rel="stylesheet" href="{{asset('datepicker/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('slide/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('slide/owl.theme.default.css')}}">
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-136080285-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-136080285-1');
    </script>
    <style>
        body {
            letter-spacing: 0.1em;
        }
    </style>
    @yield('css')
</head>
<body>
    @yield('header')
    @yield('contents')
    @php
        use App\Counter;
        use App\Daily;
        $result = Counter::select('DATE')->orderBy('DATE','desc')->first();
        $now = Carbon\Carbon::now()->toDateString();
        if($result)
        {
            if($result->DATE != $now){
                //*** บันทึกข้อมูลของเมื่อวานไปยังตาราง daily ***//
                $daily = new Daily();
                $daily->DATE = Carbon\Carbon::now()->subDay()->toDateString();
                $daily->NUM = Counter::where('DATE','=',$result->DATE)->count();
                $daily->save();
                
                //*** ลบข้อมูลของเมื่อวานในตาราง counter ***//
                if($daily == true)
                {
                    $counter = Counter::where('DATE','!=',$now)->delete();
                    
                }
            }
        }
        $counter = Counter::where('IP','=',$_SERVER["REMOTE_ADDR"])->first();
        if($counter == null)
        {
            //*** Insert Counter ปัจจุบัน ***//
            $counter = new Counter();
            $counter->DATE = $now;
            $counter->IP = $_SERVER["REMOTE_ADDR"];
            $counter->save();
        }
    @endphp
    @yield('footer')
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('slide/owl.carousel.js')}}"></script>
    <script src="{{asset('js/me.js')}}"></script>
    <script src="{{asset('datepicker/jquery-ui.min.js')}}"></script>
    @yield('scripts')
</body>
</html>