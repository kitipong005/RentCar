@extends('admin.layouts.main') 
@section('header')
    @include('admin.layouts.navbar')
@endsection 
@section('contents')
@if (Session::has('success'))
    <script>
        alert('Booking นี้ได้รับการลบเรียบร้อยแล้ว !!!!');
    </script>
@endif
<div id="wrapper">
    @include('admin.layouts.slide')
    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">ConfirmBook</a>
                </li>
                <li class="breadcrumb-item active">Form</li>
            </ol>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 col-12">
                    <table class="table text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                {{-- <th scope="col">Book_ID</th> --}}
                                <th scope="col">Bank</th>
                                <th scope="col">Created_at</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $index => $payment)
                            <tr>
                                <th scope="col">{{$index+1}}</th>
                                {{-- <th scope="col"><a href="{{url('รถเช่า/รายการรถเช่า/ยืนยัน/'.$payment->book_id)}}" target="_blank">{{$payment->book_id}}</a></th> --}}
                                <th scope="col">{{$payment->bank}}</th>
                                <th scope="col">{{$payment->created_at}}</th>
                                <th scope="col">
                                   <a href="{{action('Admin\ConfirmBookController@ConfirmBookDetail',['id'=>$payment->id,'book'=>$payment->book_id])}}" class="btn btn-success" role="button"><i class="far fa-eye fa-fw"></i></a>
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $payments->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection