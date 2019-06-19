@extends('admin.layouts.main') 
@section('header')
    @include('admin.layouts.navbar')
@endsection
 
@section('css')
<style>
    #overlay {
        background: rgb(0, 0, 0.6);
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        opacity: .2;
    }
</style>
@endsection
 
@section('contents')
<div id="wrapper">
    @include('admin.layouts.slide')
    <div id="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="#">Attraction</a>
                </li>
                <li class="breadcrumb-item active">Overview</li>
            </ol>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center">
                    @foreach($attractions as $attraction)
                        <div class="alert alert-info">
                            {!! $attraction->content !!}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
 
@section('scripts')
<script>

</script>
@endsection