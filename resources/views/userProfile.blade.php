@extends('layouts.main') 
@section('header')
    @include('layouts.navbar')
@endsection
 
@section('contents')
@if (Session::has('success'))
    <script>
        alert('Edit Data Success');
    </script>
@endif
<div class="container border" style="margin-top:7%">
    @php $name = Auth::user()->name; $fname = substr($name,0,strpos($name,' ')); $lname = substr($name,strpos($name,' ')+1);   
@endphp
    <form action="{{action('UserController@update_profile')}}" method="POST">
        {{ csrf_field() }}
        <div class="row mt-3">
            <div class="col">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-envelope fa-fw"></i></span>
                    </div>
                    <input type="email" class="form-control" name="email" aria-describedby="emailHelp" required value="{{Auth::user()->email}}"
                        readonly>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-id-card fa-fw"></i></span>
                    </div>
                    <input type="text" class="form-control" name="fname" placeholder="First Name" required value="{{$fname}}">
                </div>
                @if ($errors->has('fname'))
                <span>
                              <ul>
                                  <li><small>please Enter Name<small></li>
                              </ul>
                          </span> @endif
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-id-card fa-fw"></i></span>
                    </div>
                    <input type="text" class="form-control" name="lname" placeholder="Last Name" required value="{{$lname}}">
                </div>
                @if ($errors->has('lname'))
                <span>
                                <ul>
                                    <li><small>please Enter Name<small></li>
                                </ul>
                            </span> @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-7">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fa fa-low-vision fa-fw"></i></span>
                    </div>
                    <input type="text" class="form-control" name="code" required value="{{Auth::user()->code}}" readonly>
                </div>
            </div>
            <div class="col-md-5">
                <p style="color:red">** Select Code สามารถใช้ยืนยันตัวตนแทนได้ในการเช่ารถกรณีที่ ไม่ได้ทำการ เข้าสู่ระบบ **</p>
            </div>
        </div>
        <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-danger" onclick="return window.location.href = '/' ">cancle</button>
        </div>
</div>
</form>
</div>
@endsection
 
@section('scripts')
<script>

</script>
@endsection