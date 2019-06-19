@extends('admin.layouts.main')
@section('header')
@include('admin.layouts.navbar')
@endsection
@section('contents')
@if (Session::has('success'))
    <script>
        alert('เพิ่มรถหรือแก้ไขรถสำเร็จแล้ว !!!!');
    </script>
@elseif(Session::has('delete'))
    <script>
        alert('ลบรถสำเร็จแล้ว !!!!');
    </script>
@endif
<div id="wrapper">
        @include('admin.layouts.slide')
        <div id="content-wrapper">
            <div class="container-fluid">
                <!-- Breadcrumbs-->
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Car</a>
                    </li>
                    <li class="breadcrumb-item active">List Cars</li>
                </ol>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <table class="table">
                            <thead class="thead-dark">
                              <tr>
                                <th scope="col">#</th>
                                <th scope="col">Picture</th>
                                <th scope="col">License</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Model</th>
                                <th scope="col">Type</th>
                                <th scope="col">Price</th>
                                <th scope="col">Status</th>
                                <th scope="col">Number</th>
                                <th scope="col">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($cars as $index => $car)
                                <tr>
                                    <th scope="col">{{$index+1}}</th>
                                    <th scope="col"><img src="img/cars/{{$car->pic}}" alt="" width="70px" height="50px"></th>
                                    <th scope="col">{{$car->license}}</th>
                                    <th scope="col">{{$car->brand->name}}</th>
                                    <th scope="col">{{$car->model->name}}</th>
                                    <th scope="col">{{$car->type->name}}</th>
                                    <th scope="col">{{$car->price}}</th>
                                    @if ($car->status == 0)
                                        <th scope="col" style="color:green;">พร้อมใช้งาน</th>
                                    @else 
                                        <th scope="col" style="color:red;">ไม่พร้อมใช้งาน</th>
                                    @endif
                                    <th scope="col">{{$car->count}}</th>
                                    <th scope="col">
                                        <a href="{{action('Admin\CarController@editListCarForm',['id'=>$car->id])}}" role="button" class="btn btn-warning"><i class="fas fa-fw fa-pen"></i></a>
                                        <a href="{{action('Admin\CarController@deleteCar',['id'=>$car->id])}}" role="button" class="btn btn-danger" onclick="return confirm('ต้องการลบจริงหรือไม่ !!!')"><i class="fas fa-fw fa-trash"></i></a>
                                    </th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                                {{ $cars->links('vendor.pagination.bootstrap-4') }} 
                        </div>                     
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection