@extends('admin.layouts.main') 
@section('header')
    @include('admin.layouts.navbar')
@endsection 
@section('contents')
<div id="wrapper">
    @include('admin.layouts.slide')
    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">ConfirmBook</a>
                </li>
                <li class="breadcrumb-item active">PDF</li>
            </ol>
        </div>
        <div class="container-fluid">
            @if (Session::has('success'))
                <script>
                    alert('ส่งรถให้ลูกค้าเรียบร้อยแล้ว');
                </script>
            @elseif (Session::has('error'))
                <script>
                    alert('เกิดข้อผิดพลาดกรุณาตรวจสอบข้อมูลให้ถูกต้อง');
                </script>
            @endif
            <div class="row">
                <div class="col-md-12 col-12">
                    <table class="table text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                {{-- <th scope="col">Book_ID</th> --}}
                                <th scope="col">ชื่อ-สกุล</th>
                                <th scope="col">Start</th>
                                <th scope="col">End</th>
                                <th scope="col">Landmark</th>
                                <th scope="col">Updated_at</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payments as $index => $payment)
                            <tr>
                                <th scope="col">{{$index+1}}</th>
                                {{-- <th scope="col"><a href="{{url('รถเช่า/รายการรถเช่า/ยืนยัน/'.$payment->book_id)}}" target="_blank">{{$payment->book_id}}</a></th> --}}
                                <th scope="col">{{$payment->book->name}}</th>
                                <th scope="col">{{$payment->book->s_date}} {{$payment->book->timestart->detail}}</th>
                                <th scope="col">{{$payment->book->e_date}} {{$payment->book->timeend->detail}}</th>
                                <th scope="col">{{$payment->book->landmark->nameTH}}</th>
                                <th scope="col">{{$payment->created_at}}</th>
                                <th scope="col">
                                    <div class="col-md-12 form-inline">
                                            <form action="{{action('Admin\ConfirmBookController@sendCarSuccess')}}" method="post">
                                                {{ csrf_field() }}
                                                    <input type="hidden" name="id" value="{{$payment->id}}">
                                                    <button type="submit" class="btn btn-success"><i class="fas fa-check"></i></button>
                                            </form>
                                            <form action="{{action('PdfController@generate_pdf_rent_car',['payment'=>$payment->id])}}" method="get" target="_blank">
                                                    {{-- <input type="hidden" name="" value="{{$payment->id}}"> --}}
                                                    <button type="submit" class="btn btn-primary"><i class="fas fa-file-alt"></i></button>
                                            </form>
                                            {{-- <a href="{{action('Admin\ConfirmBookController@ConfirmBookDetail',['id'=>$payment->id,'book'=>$payment->book_id])}}" class="btn btn-success" role="button"><i class="far fa-eye fa-fw"></i></a> --}}
                                    </div>
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