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
                    <a href="#">Car</a>
                </li>
                <li class="breadcrumb-item active">Model Car</li>
            </ol>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center">
                    @if ($errors->has('error'))
                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Error!</strong> {{$errors->get('error')}}
                    </div>
                    @endif
                    <form action="#" method="post" id="model-add">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <div class="col-md-5">
                                <select name="brand_id" id="brand_id" class="form-control" required>
                                    @foreach ($brands as $brand)
                                        <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-5">
                                <input type="text" class="form-control" name="name" placeholder="Name Model Car" required>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-plus-circle"></i> Model</button>
                            </div>
                        </div>
                    </form>

                    <table class="table" id="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($models as $index => $model)
                                <tr class="pos{{$model->id}}">
                                    <th scope="col">{{$model->brand->name}}</th>
                                    <th scope="col">{{$model->name}}</th>
                                    <th scope="col">
                                        <a href="" role="button" class="btn btn-warning" data-id={{$model->id}} id="model-edit"><i
                                                class="fas fa-fw fa-pen"></i></a>
                                        <a href="" role="button" class="btn btn-danger" data-id={{$model->id}} id="model-delete"><i
                                                class="fas fa-fw fa-trash"></i></a>
                                    </th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    <div class="text-center">
                        {{ $models->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="overlay" style="display: none;"></div>
    <!-- Modal -->
    <form method="post" id="model-update">
        {{ csrf_field() }}
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Landmark</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="form-group row">
                            <div class="col-md-6">
                                <select name="brand" id="brand" class="form-control">
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" id="name" placeholder="Name Model Car" required>
                            </div>
                            <input type="hidden" name="id" id="id">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success"><i class="far fa-check-circle">Update</i></button>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
@endsection
 
@section('scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    // model add ----------->
    $('#model-add').on('submit',function(e){
        e.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            url: "{{ action('Admin\CarController@Modeladd') }}",
            method: 'post',
            data: data,
            dataType: "json",
            async: false,
            success: function(data){
                $('#table').append(
                    "<tr class='pos"+data.id+"'>"+
                    "<th>" + data.brand.name + "</th>"+
                    "<th>" + data.name + "</th>"+
                    "<th>"+
                        "<a href='' role='button' class='btn btn-warning' data-id='"+data.id+"' id='model-edit'><i class='fas fa-fw fa-pen'></i></a>"+
                        "<a href='' role='button' class='btn btn-danger' data-id='"+data.id+"' id='model-delete'><i class='fas fa-fw fa-trash'></i></a>"+
                    "</th>"+
                    "</tr>"
                );
                $('input[name="name"]').val('');
            }
        });
    });
    // brand edit ----------->
    $('#table').on('click','#model-edit',function(e){
        e.preventDefault();
        var dataId = $(this).attr("data-id");
        $.ajax({
            url: "{{ action('Admin\CarController@Modelget') }}",
            method: 'get',
            data: {
                // '_token': $('input[name=_token]').val(),
                'id': dataId,
            },
            dataType: "json",
            async: false,
            success: function(data){
                $('#brand').html(data[1].map(e=>'<option value=' + e.id + '>' + e.name + '</option>'));
                $('#brand option[value='+data[0].brand_id+']').attr('selected','selected');
                $('#name').val(data[0].name);
                $('#id').val(data[0].id);
                $('#myModal').modal('show'); 
            }
        });
    })
    $('#model-update').on('submit',function(e){
        e.preventDefault();
        var dataId = $(this).serialize();
        $.ajax({
            url: "{{ action('Admin\CarController@Modeledit') }}",
            method: 'post',
            data: dataId,
            dataType: "json",
            async: false,
            success: function(data){
                $(".pos"+data.id).replaceWith(
                    "<tr class='pos"+data.id+"'>"+
                    "<th>" + data.brand.name + "</th>"+
                    "<th>" + data.name + "</th>"+
                    "<th>"+
                        "<a href='' role='button' class='btn btn-warning' data-id='"+data.id+"' id='model-edit'><i class='fas fa-fw fa-pen'></i></a>"+
                        "<a href='' role='button' class='btn btn-danger' data-id='"+data.id+"' id='model-delete'><i class='fas fa-fw fa-trash'></i></a>"+
                    "</th>"+
                    "</tr>");
                $('#myModal').modal('hide');
            }
        });
    })
    // model delete ----------->
    $('#table').on('click','#model-delete',function(e){
        e.preventDefault();
        var c = confirm('sure ??');
        if(c == true)
        {
            var dataId = $(this).attr("data-id");
            $.ajax({
                url: "{{ action('Admin\CarController@Modeldelete') }}",
                method: 'post',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': dataId,
                },
                dataType: "json",
                async: false,
                success: function(data){
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