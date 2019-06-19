@extends('admin.layouts.main')
@section('header')
@include('admin.layouts.navbar')
@endsection
@section('contents')
@if (Session::has('error'))
    <script>
        alert('ทำการแก้ไขล้มเหลว โปรดลองใหม่อีกครั้ง !!!');
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
                <li class="breadcrumb-item active">Edit Cars</li>
            </ol>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12 col-md-12 col-sm-6 mb-3">
                    <div class="card text-white bg-secondary o-hidden h-100">
                        <div class="card-header text-center">
                            <h3><i class="fas fa-car"></i>Edit Car</h3>
                        </div>             
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fas fa-2x fa-car"></i>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-8">
                                    <form action="{{action('Admin\CarController@editListCar')}}" method="post" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="form-group row">
                                                <label for="inputPassword" class="col-form-label">License: </label>
                                                <div class="col-md-10">
                                                    <input type="text" class="form-control" id="license" placeholder="license" name="license" value="{{$car->license}}" required autocomplete="off">
                                                    {{-- @if ($errors->has('error'))
                                                        <span class="text-danger">
                                                            <ul>
                                                                <li>{{'ป้ายทะเบียน(license) นี้มีอยู่ในระบบแล้ว !!!'}}</li>    
                                                            </ul>
                                                        </span>
                                                    @endif --}}
                                                </div>
                                        </div>
                                        <div class="row form-group">
                                            <label for="inputPassword" class="col-form-label">Brand: &nbsp;</label>  
                                            <div class="col-md-5">
                                                <select name="brand" id="brand" class="form-control" onchange="changeBrand()">
                                                    <option value="">Please Select Car Brand ::</option>
                                                    <option value="{{$car->brand->id}}" selected>{{$car->brand->name}}</option>
                                                    @foreach ($brands as $brand)
                                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <label for="inputPassword" class="col-form-label" data-role="none">Model: </label>   
                                            <div class="col-md-5">
                                                <select name="model" id="model" class="form-control" required>
                                                    <option value="{{$car->model->id}}" selected>{{$car->model->name}}</option>
                                                </select>
                                            </div>
                                        </div>
                                         <div class="row form-group">
                                            <label for="inputPassword" class="col-form-label">Type: </label>   
                                            <div class="col-md-5">
                                                <select name="type" id="type" class="form-control" required>
                                                    <option value="{{$car->type->id}}" selected>{{$car->type->name}}</option>
                                                    @foreach ($types as $type)
                                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <label for="seat" class="col-form-label">Seat: &nbsp;&nbsp;</label>   
                                            <div class="col-md-5">
                                                <select name="seat" id="seat" class="form-control" value="{{old('seat')}}">
                                                    <option value="{{$car->seat}}" selected>{{$car->seat}} คน</option>
                                                    <option value="1-2" {{ old('seat') == "1-2" ? 'selected' : '' }}>1-2 คน</option>
                                                    <option value="2-4" {{ old('seat') == "2-4" ? 'selected' : '' }}>2-4 คน</option>
                                                    <option value="4-6" {{ old('seat') == "4-6" ? 'selected' : '' }}>4-6 คน</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label for="gear" class="col-form-label">Gear: </label>   
                                            <div class="col-md-5">
                                                <select name="gear" id="gear" class="form-control" value="{{old('gear')}}">
                                                    <option value="{{$car->gear}}">{{$car->gear}}</option>
                                                    <option value="automatic" {{ old('gear') == "automatic" ? 'selected' : '' }}>Automatic</option>
                                                    <option value="manual" {{ old('gear') == "manual" ? 'selected' : '' }}>Manual</option>
                                                </select>
                                            </div>
                                            <label for="door" class="col-form-label">Door: &nbsp;&nbsp;</label>   
                                            <div class="col-md-5">
                                                <select name="door" id="door" class="form-control" value="{{old('door')}}">
                                                    @if ($car->door == null)
                                                    <option value="">Select Door :: </option>
                                                    @else
                                                    <option value="{{$car->door}}">{{$car->door}} Door</option>
                                                    @endif
                                                    <option value="4" {{ old('door') == "4" ? 'selected' : '' }}>4 Door</option>
                                                    <option value="5" {{ old('door') == "5" ? 'selected' : '' }}>5 Door</option>
                                                    <option value="6" {{ old('door') == "6" ? 'selected' : '' }}>6 Door</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label for="air" class="col-form-label">Air:  &nbsp;</label>   
                                            <div class="col-md-5">
                                                <select name="air" id="air" class="form-control" value="{{old('air')}}">
                                                    @if ($car->air == 'yes')
                                                    <option value="no">No have Air Condition</option>
                                                    <option value="yes" selected>have Air Condition</option>
                                                    @else
                                                    <option value="no" selected>No have Air Condition</option>
                                                    <option value="yes">have Air Condition</option>
                                                    @endif
                                                </select>
                                            </div>
                                            <label for="price" class="col-form-label">Price:  &nbsp;&nbsp;</label>  
                                            <div class="col-md-5">
                                                <input type="text" class="form-control" id="price" placeholder="Enter Price / day" name="price" value="{{$car->price}}" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <input type="hidden" name="id" value="{{$car->id}}">
                                                <label for="picture" class="col-form-label">Image:&nbsp;&nbsp;</label>
                                                <div class="col-md-4">
                                                    <input type="file" name="picture" class="form-control">
                                                </div>
                                                <label for="picture" class="col-form-label">Number:&nbsp;&nbsp;</label>
                                                <div class="col-md-4">
                                                    <input type="number" name="count" class="form-control" value="{{$car->count}}" required>
                                                </div>
                                        </div> 
                                </div>
                            </div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1 text-right" href="#">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </a>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
    {{-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> --}}

@endsection