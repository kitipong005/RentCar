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
<div class="container" style="margin-top:10%;">
  <div class="row"  style="background-image:linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('{{asset('img/พื้นหลังรถเช่าเชียงใหม่.jpg')}}')">
    <div style="width:100%" class="text-left">
      <img src="{{asset('img/สินค้ารถเช่า.png')}}" width="auto" height="200px;" alt="รถเช่าเชียงใหม่ เช่ารถเชียงใหม่ เช่ารถจักรยานยนต์เชียงใหม่" style="margin:2% 0 2% 2%;">
    </div>
    <div class="offset-md-2 col-md-8">
        <table class="table text-center bg-white"> 
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">รหัสสินค้า</th>
                <th scope="col">เบอร์โทรศัพท์</th>
                <th scope="col">วันที่ทำการจอง</th>
                <th scope="col">ราคา</th>
                <th scope="col">รายละเอียด</th>
              </tr>
            </thead>
            <tbody>
                @if (!$books->isEmpty())
                @foreach ($books as $index => $book)
                <tr>
                    <th scope="col">{{$index+1}}</th>
                    <td>{{$book->code}}</td>
                    <td>{{$book->phone}}</td>
                    <td>{{$book->created_at}}</td>
                    <td>{{$book->price}}</td>
                    <td>
                        <a href="{{action('BookController@paymentConfirm',['book'=>$book->id])}}" role="button" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                    </td>
                </tr>
                @endforeach
                @else
                <tr>
                    <th scope="col" style="color:red" colspan="6">**** ไม่มีข้อมูล ****</th>
                </tr>
                @endif
            </tbody>
        </table>
    </div>
    </div>
  {{-- end row 1 --}}
</div>
<div class="text-center mt-5">
  {{ $books->links('vendor.pagination.bootstrap-4') }} 
</div>      
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