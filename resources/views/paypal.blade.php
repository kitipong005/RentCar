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
    .main-contain{
        position: absolute;  
        top: 0px;   
        left: 0px;  
        width: 100%;   
        height: 100%;   
        overflow: hidden;
    }
 
 </style>
@endsection
@section('contents')
<div id="overlay"></div>
<div class="main-contain">
<form action="{{action('PaymentController@paypalPay')}}" method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="id_car" id="" value="{{$pay[0]}}">
    <input type="hidden" name="price" id="" value="{{$pay[1]}}">
    {{-- <button class="btn btn-primary" type="submit">Paypal</button> --}}
</form>
</div>
@endsection
@section('scripts')
    <script>
        $(function(){
            $("#overlay").fadeOut();
            $(".main-contain").removeClass("main-contain");
            $('form').submit();
        })
    </script>
@endsection