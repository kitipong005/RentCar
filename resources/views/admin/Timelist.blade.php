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
                    <a href="#">Car</a>
                </li>
                <li class="breadcrumb-item active">Time Rent</li>
            </ol>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="row">
                        <div class="col-md-6">
                                <form action="{{action('Admin\TimeController@TimeStartadd')}}" method="post" id="timeS-add">
                                        {{ csrf_field() }}
                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="timeS" placeholder="00:00" pattern="\d{2}[:]\d{2}" required>
                                        @if ($errors->has('timeS'))
                                        <p style="color:red">Please Enter Time Start</p>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary btn-block"><i
                                                class="fas fa-plus-circle"></i> TimeStart</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                                <form action="{{action('Admin\TimeController@TimeEndadd')}}" method="post" id="timeE-add">
                                        {{ csrf_field() }}
                                <div class="form-group row">
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="timeE" placeholder="00:00" pattern="\d{2}[:]\d{2}" required>
                                        @if ($errors->has('timeE'))
                                        <p style="color:red">Please Enter Time End</p>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-primary btn-block"><i
                                                class="fas fa-plus-circle"></i> TimeEnd</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="table" id="tableS">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">TimeStart</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($timesS as $index => $timeS)
                            <tr class="pos{{$timeS->id}}">
                                <th scope="col">{{$timeS->id}}</th>
                                <th scope="col">{{$timeS->detail}}</th>
                                <th scope="col">
                                    <a href="" role="button" class="btn btn-warning" data-id={{$timeS->id}} id="timeS-edit"><i
                                            class="fas fa-fw fa-pen"></i></a>
                                    <a href="" role="button" class="btn btn-danger" data-id={{$timeS->id}} id="timeS-delete"><i
                                            class="fas fa-fw fa-trash"></i></a>
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                            {{ $timesS->links('vendor.pagination.bootstrap-4') }} 
                    </div>
                    <table class="table" id="tableE">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">TimeEnd</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($timesE as $index => $timeE)
                            <tr class="pos{{$timeE->id}}">
                                <th scope="col">{{$timeE->id}}</th>
                                <th scope="col">{{$timeE->detail}}</th>
                                <th scope="col">
                                    <a href="" role="button" class="btn btn-warning" data-id={{$timeE->id}} id="timeE-edit"><i
                                            class="fas fa-fw fa-pen"></i></a>
                                    <a href="" role="button" class="btn btn-danger" data-id={{$timeE->id}} id="timeE-delete"><i
                                            class="fas fa-fw fa-trash"></i></a>
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                            {{ $timesE->links('vendor.pagination.bootstrap-4') }} 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- start modal time start --}}
<div class="modal fade" id="myModalS" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit TimeStart</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="#" method="post" id="timeS-update">
            <div class="modal-body">                
                    {{ csrf_field() }}
                    <input type="hidden" name="timeSId" id="timeSId">
                    <input type="text" class="form-control" name="detailS" id="detailS">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success"><i class="far fa-check-circle">Update</i></button>
            </div>
            </form>
          </div>
        </div>
      </div>
      
{{-- end modal --}}
{{-- start modal time end --}}
<div class="modal fade" id="myModalE" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Brand</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="#" method="post" id="timeE-update">
            <div class="modal-body">                
                    {{ csrf_field() }}
                    <input type="hidden" name="timeEId" id="timeEId">
                    <input type="text" class="form-control" name="detailE" id="detailE">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success"><i class="far fa-check-circle">Update</i></button>
            </div>
            </form>
          </div>
        </div>
      </div>
      
{{-- end modal --}}
@endsection
@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        // time add ----------->
        $('#timeS-add').on('submit',function(e){
            e.preventDefault();
            var data = $(this).serialize();
            console.log(data);
            $.ajax({
                url: "{{ action('Admin\TimeController@TimeStartadd') }}",
                method: 'post',
                data: data,
                dataType: "json",
                async: false,
                success: function(data){
                    console.log(data)
                    $('#tableS').append(
                        "<tr class='pos"+data.id+"'>"+
                        "<th>" + data.id + "</th>"+
                        "<th>" + data.detail + "</th>"+
                        "<th>"+
                            "<a href='' role='button' class='btn btn-warning' data-id='"+data.id+"' id='timeS-edit''><i class='fas fa-fw fa-pen'></i></a>"+
                            "<a href='' role='button' class='btn btn-danger' data-id='"+data.id+"' id='timeS-delete''><i class='fas fa-fw fa-trash'></i></a>"+
                        "</th>"+
                        "</tr>"
                    );
                    $('input[name="timeS"]').val('');
                }
            });
        });
        $('#timeE-add').on('submit',function(e){
            e.preventDefault();
            var data = $(this).serialize();
            console.log(data);
            $.ajax({
                url: "{{ action('Admin\TimeController@TimeEndadd') }}",
                method: 'post',
                data: data,
                dataType: "json",
                async: false,
                success: function(data){
                    console.log(data)
                    $('#tableE').append(
                        "<tr class='pos"+data.id+"'>"+
                        "<th>" + data.id + "</th>"+
                        "<th>" + data.detail + "</th>"+
                        "<th>"+
                            "<a href='' role='button' class='btn btn-warning' data-id='"+data.id+"' id='timeE-edit'><i class='fas fa-fw fa-pen'></i></a>"+
                            "<a href='' role='button' class='btn btn-danger' data-id='"+data.id+"' id='timeE-delete'><i class='fas fa-fw fa-trash'></i></a>"+
                        "</th>"+
                        "</tr>"
                    );
                    $('input[name="timeE"]').val('');
                }
            });
        });
        // type edit ----------->
        $('#tableS').on('click','#timeS-edit',function(e){
            e.preventDefault();
            var dataId = $(this).attr("data-id");
            $.ajax({
                url: "{{ action('Admin\TimeController@TimeStartget') }}",
                method: 'get',
                data: {
                    // '_token': $('input[name=_token]').val(),
                    'id': dataId,
                },
                dataType: "json",
                async: false,
                success: function(data){
                    $('#timeSId').val(data.id);
                    $('#detailS').val(data.detail);
                    $('#myModalS').modal('show'); 
                }
            });
        })
        $('#tableE').on('click','#timeE-edit',function(e){
            e.preventDefault();
            var dataId = $(this).attr("data-id");
            $.ajax({
                url: "{{ action('Admin\TimeController@TimeEndget') }}",
                method: 'get',
                data: {
                    // '_token': $('input[name=_token]').val(),
                    'id': dataId,
                },
                dataType: "json",
                async: false,
                success: function(data){
                    $('#timeEId').val(data.id);
                    $('#detailE').val(data.detail);
                    $('#myModalE').modal('show'); 
                }
            });
        })
        $('#timeS-update').on('submit',function(e){
            e.preventDefault();
            var dataId = $(this).serialize();
            $.ajax({
                url: "{{ action('Admin\TimeController@TimeStartedit') }}",
                method: 'post',
                data: dataId,
                dataType: "json",
                async: false,
                success: function(data){
                    $("#tableS .pos"+data.id).replaceWith(
                        "<tr class='pos"+data.id+"'>"+
                        "<th>" + data.id + "</th>"+
                        "<th>" + data.detail + "</th>"+
                        "<th>"+
                            "<a href='' role='button' class='btn btn-warning' data-id='"+data.id+"' id='timeS-edit'><i class='fas fa-fw fa-pen'></i></a>"+
                            "<a href='' role='button' class='btn btn-danger' data-id='"+data.id+"' id='timeS-delete'><i class='fas fa-fw fa-trash'></i></a>"+
                        "</th>"+
                        "</tr>");
                    $('#myModalS').modal('hide');
                }
            });
        })
        $('#timeE-update').on('submit',function(e){
            e.preventDefault();
            var dataId = $(this).serialize();
            $.ajax({
                url: "{{ action('Admin\TimeController@TimeEndedit') }}",
                method: 'post',
                data: dataId,
                dataType: "json",
                async: false,
                success: function(data){
                    $("#tableE .pos"+data.id).replaceWith(
                        "<tr class='pos"+data.id+"'>"+
                        "<th>" + data.id + "</th>"+
                        "<th>" + data.detail + "</th>"+
                        "<th>"+
                            "<a href='' role='button' class='btn btn-warning' data-id='"+data.id+"' id='timeE-edit'><i class='fas fa-fw fa-pen'></i></a>"+
                            "<a href='' role='button' class='btn btn-danger' data-id='"+data.id+"' id='timeE-delete'><i class='fas fa-fw fa-trash'></i></a>"+
                        "</th>"+
                        "</tr>");
                    $('#myModalE').modal('hide');
                }
            });
        })
        // type delete ----------->
        $('#tableS').on('click','#timeS-delete',function(e){
            e.preventDefault();
            var c = confirm('are your sure ??');
            if(c == true)
            {
                var dataId = $(this).attr("data-id");
                $.ajax({
                    url: "{{ action('Admin\TimeController@TimeStartdelete') }}",
                    method: 'post',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'id': dataId,
                    },
                    dataType: "json",
                    async: false,
                    success: function(data){
                        console.log(data);
                        if(data == true)
                        {
                            $("#tableS .pos"+dataId).remove();
                        }
                    }
                });
            }
        })
        $('#tableE').on('click','#timeE-delete',function(e){
            e.preventDefault();
            var c = confirm('are your sure ??');
            if(c == true)
            {
                var dataId = $(this).attr("data-id");
                $.ajax({
                    url: "{{ action('Admin\TimeController@TimeEnddelete') }}",
                    method: 'post',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'id': dataId,
                    },
                    dataType: "json",
                    async: false,
                    success: function(data){
                        console.log(data);
                        if(data == true)
                        {
                            $("#tableE .pos"+dataId).remove();
                        }
                    }
                });
            }
        })
    </script>
@endsection