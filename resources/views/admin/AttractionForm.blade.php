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
                    <a href="#">Attraction</a>
                </li>
                <li class="breadcrumb-item active">Form</li>
            </ol>
        </div>
        <div class="container-fluid">
            <form action="{{action('Admin\AttractionController@add_attraction')}}" method="POST">
                {{ csrf_field() }}
                <div class="form-group row">
                    <label for="staticEmail" class="col-md-1 col-form-label">Title: </label>
                    <div class="col-sm-6">
                        <input type="text" class="form-control" id="title" name="title" required style="font-size: 2em;">
                    </div>
                    <label for="language" class="col-md-1 col-form-label">Language: </label>
                    <div class="col-sm-3">
                        {{-- <input type="text" class="form-control" id="language" name="language" required> --}}
                        <select name="language" id="language" class="form-control" required>
                            <option value="" disabled selected>Please Select Language</option>
                            <option value="th">Thai</option>
                            <option value="en">English</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row block-content">

                </div>
                <br>
            </form>
        </div>
        {{-- End Summer Note --}}
    </div>
</div>
@endsection
 
@section('scripts')
<script>
    $(document).on('mouseover','.block-content')
    {
        
    }
</script>
@endsection