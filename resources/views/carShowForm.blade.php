@extends('layouts.main')
@section('header')
@include('layouts.navbar')
{{-- <div class="row mt-5">
  <div class="col" style="background:url(../img/bg-logo2.jpg);">
    @include('layouts.search')
  </div>
</div> --}}
@endsection

@section('contents')
@if (Session::get('error'))
  <script>
    alert('paypal Fail Please Select car !!!');
  </script>
@endif
@if (Session::get('errorBooking'))
  <script>
    alert(' No have data booking Please Contact us!!!');
  </script>
@endif
<div class="container mt">
  <div class="row" style="background-image:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{asset('img/พื้นหลังรถเช่าเชียงใหม่.jpg')}}')">
    <div style="width:100%" class="text-left res-pic-product">
      <img src="{{asset('img/สินค้ารถเช่า.png')}}" width="auto" height="200px;" alt="รถเช่าเชียงใหม่ เช่ารถเชียงใหม่ เช่ารถจักรยานยนต์เชียงใหม่" style="margin:2% 0 2% 2%;">
    </div>
        @foreach ($cars as $car)
        <div class="col-md-4 col-12">
            <div class="card">
                <img src="{{ asset('img/cars/'.$car->pic) }}" alt="" width="100%" height="auto" class="rounded"/>
                <div class="card-body border">
                    {{-- <div>
                        <h4>
                          <i><img src="{{ asset('img/car.png') }}" alt="" width="25" height="25" /></i> {{$car->brand->name}} {{$car->model->name}} 
                        </h4>
                      </div> --}}
                      <div>
                        <i><img src="{{ asset('img/user.png') }}" alt="" width="16" height="16" /></i> ที่นั่ง {{$car->seat}} คน
                      </div>
                      <div>
                        <i><img src="{{ asset('img/gearcar.png') }}" alt="" width="16" height="16" /></i> เกียร์ {{$car->gear}}
                      </div>
                      <div>
                        <i><img src="{{ asset('img/car-door.png') }}" alt="" width="16" height="16" /></i> ประตู 
                        @if ($car->door == null)
                            -
                        @else
                            {{$car->door}}               
                        @endif
                      </div>
                      <div>
                        <i><img src="{{ asset('img/location.png') }}" alt="" width="16" height="16" /></i> แอร์คอนดิชั่น
                        @if ($car->door == null)
                          No Have
                      @else
                          Have               
                      @endif
                      </div>
                      <div>
                        <i><img src="{{ asset('img/dollar.png') }}" alt="" width="16" height="16" /></i> ราคา {{$car->price}} Bath/day
                      </div>
                </div>
                <div class="card-footer text-right">
                  <div class="row">
                      <div class="col-md-12 col-12">
                        <form action="{{action('BookController@cart',['id'=>$car->id])}}" method="get">
                          <button type="submit" class="btn btn-warning btn-block btn-zoom"><i class="fa fa-drivers-license fa-lg"></i> >> คลิกเพื่อเช่ารถ <<</button>
                        </form>
                      </div>
                  </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
  {{-- end row 1 --}}
</div>
<div class="text-center mt-5">
  {{ $cars->links('vendor.pagination.bootstrap-4') }} 
</div>
@include('layouts.regisModal')
@include('layouts.Login')      
@endsection
@section('scripts')
<script src="{{ asset('js/jquery.ThaiAddress.En-Th.js') }}"></script>
<script>
  $(document).on("click", ".booking", function () {
    var id = $('input[name="id_car"]').val($(this).data("id"));
    //console.log($(this).data("id"));
    $("form").submit();
  });

</script>
@endsection