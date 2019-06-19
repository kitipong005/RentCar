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
                <li class="breadcrumb-item active">Type</li>
            </ol>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center">
                    <form action="{{action('Admin\CarController@Typeadd')}}" method="post" id="type-add">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <div class="col-md-5 offset-md-5">
                                <input type="text" class="form-control" name="type" placeholder="Type Car" required>
                                @if ($errors->has('type'))
                                <p style="color:red">Please Enter Type Car</p>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary btn-block"><i
                                        class="fas fa-plus-circle"></i> Type</button>
                            </div>
                        </div>
                    </form>
                    <table class="table" id="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Type</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($types as $index => $type)
                            <tr class="pos{{$type->id}}">
                                <th scope="col">{{$type->id}}</th>
                                <th scope="col">{{$type->name}}</th>
                                <th scope="col">
                                    <a href="" role="button" class="btn btn-warning" data-id={{$type->id}} id="type-edit"><i
                                            class="fas fa-fw fa-pen"></i></a>
                                    <a href="" role="button" class="btn btn-danger" data-id={{$type->id}} id="type-delete"><i
                                            class="fas fa-fw fa-trash"></i></a>
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                            {{ $types->links('vendor.pagination.bootstrap-4') }} 
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- start modal --}}
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Edit Brand</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{action('Admin\CarController@Typeedit')}}" method="post" id="type-update">
            <div class="modal-body">                
                    {{ csrf_field() }}
                    <input type="hidden" name="typeId" id="typeId">
                    <input type="text" class="form-control" name="name" id="name">
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
    // type add ----------->
    $('#type-add').on('submit',function(e){
        e.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            url: "{{ action('Admin\CarController@Typeadd') }}",
            method: 'post',
            data: data,
            dataType: "json",
            async: false,
            success: function(data){
                $('#table').append(
                    "<tr class='pos"+data.id+"'>"+
                    "<th>" + data.id + "</th>"+
                    "<th>" + data.name + "</th>"+
                    "<th>"+
                        "<a href='' role='button' class='btn btn-warning' data-id='"+data.id+"' id='type-edit'><i class='fas fa-fw fa-pen'></i></a>"+
                        "<a href='' role='button' class='btn btn-danger' data-id='"+data.id+"' id='type-delete'><i class='fas fa-fw fa-trash'></i></a>"+
                    "</th>"+
                    "</tr>"
                );
                $('input[name="type"]').val('');
            }
        });
    });
    // type edit ----------->
    $('#table').on('click','#type-edit',function(e){
        e.preventDefault();
        var dataId = $(this).attr("data-id");
        $.ajax({
            url: "{{ action('Admin\CarController@Typeget') }}",
            method: 'get',
            data: {
                // '_token': $('input[name=_token]').val(),
                'id': dataId,
            },
            dataType: "json",
            async: false,
            success: function(data){
                $('#typeId').val(data.id);
                $('#name').val(data.name);
                $('#myModal').modal('show'); 
            }
        });
    })
    $('#type-update').on('submit',function(e){
        e.preventDefault();
        var dataId = $(this).serialize();
        $.ajax({
            url: "{{ action('Admin\CarController@Typeedit') }}",
            method: 'post',
            data: dataId,
            dataType: "json",
            async: false,
            success: function(data){
                console.log(data);
                $(".pos"+data.id).replaceWith(
                    "<tr class='pos"+data.id+"'>"+
                    "<th>" + data.id + "</th>"+
                    "<th>" + data.name + "</th>"+
                    "<th>"+
                        "<a href='' role='button' class='btn btn-warning' data-id='"+data.id+"' id='type-edit'><i class='fas fa-fw fa-pen'></i></a>"+
                        "<a href='' role='button' class='btn btn-danger' data-id='"+data.id+"' id='type-delete'><i class='fas fa-fw fa-trash'></i></a>"+
                    "</th>"+
                    "</tr>");
                $('#myModal').modal('hide');
            }
        });
    })
    // type delete ----------->
    $('#table').on('click','#type-delete',function(e){
        e.preventDefault();
        var c = confirm('are your sure ??');
        if(c == true)
        {
            var dataId = $(this).attr("data-id");
            $.ajax({
                url: "{{ action('Admin\CarController@Typedelete') }}",
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
                        $(".pos"+dataId).remove();
                    }
                }
            });
        }
    })
</script>
@endsection