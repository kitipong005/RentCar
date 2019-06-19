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
                    <a href="#">Landmark</a>
                </li>
                <li class="breadcrumb-item active">Overview</li>
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
                    <form action="{{action('Admin\LandmarkController@add_landmark')}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group row">
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="nameTH" placeholder="Name Landmark TH" required>                                @if ($errors->has('nameTH'))
                                <p style="color:red">Please without spaces</p>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="nameEN" placeholder="Name Landmark EN" required>                                @if ($errors->has('nameEN'))
                                <p style="color:red">Please without spaces Or English language</p>
                                @endif
                            </div>
                            <div class="col-md-2">
                                <input type="number" name="priceTranspot" id="priceTranspot" class="form-control" placeholder="price transpot" required>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-plus-circle"></i> Landmark</button>
                            </div>
                        </div>
                    </form>

                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                {{-- <th scope="col">#</th> --}}
                                <th scope="col">nameTH</th>
                                <th scope="col">nameEN</th>
                                <th scope="col">priceTranspot</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($landmarks as $index => $landmark)
                            <tr id="tr{{$landmark->id}}">
                                {{-- <th scope="col" id="number">{{$index+1}}</th> --}}
                                <th scope="col">{{$landmark->nameTH}}</th>
                                <th scope="col">{{$landmark->nameEN}}</th>
                                <th scope="col">{{$landmark->priceTranspot}}</th>
                                <th scope="col">
                                    <button class="btn btn-warning" id="edit_landmark" data-id="{{$landmark->id}}"><i class="fas fa-edit fa-fw"></i></button>
                                    <button class="btn btn-danger" id="del_landmark" data-id="{{$landmark->id}}"><i class="fas fa-trash-alt fa-fw"></i></button>
                                </th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="text-center">
                        {{ $landmarks->links('vendor.pagination.bootstrap-4') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="overlay" style="display: none;"></div>
    <!-- Modal -->
    <form method="post" id="myForm">
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
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="nameTH" id="nameTH" placeholder="Name Landmark TH" required>                                @if ($errors->has('nameTH'))
                                <p style="color:red">Please without spaces</p>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="nameEN" id="nameEN" placeholder="Name Landmark EN" required>                                @if ($errors->has('nameEN'))
                                <p style="color:red">Please without spaces Or English language</p>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <input type="number" class="form-control" name="price" id="price" placeholder="price transpot" required>
                            </div>
                            <input type="hidden" name="id_landmark" id="id_landmark" value="">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="edit-submit"><i class="fas fa-edit fa-fw"></i> Edit</button>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
@endsection
 
@section('scripts')
<script>
    $(function(){
        //---------------- delete landmark -----------------------
            $(document).on('click','#del_landmark',function() {
                var delete_id = $(this).data('id');
                var el = this.closest( "tr" );
                $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
                });
                $.ajax({
                    url: "/admin-dellandmark/"+delete_id,
                    method: 'delete',
                    data: {
                        '_token': $('input[name=_token]').val(),
                    },
                    dataType: "json",
                    async: false,
                    beforeSend: function () { $('#overlay').css('display','') },
                    success: function(result){
                        if(result == 'success')
                        {
                            $('#overlay').css('display','none')
                            el.remove()
                        }
                        else {
                            alert('cant delete this data !!! ')
                        }
                    }
                });
            });
        //----------------- edit landmark ------------------------
        //---- show data in modal ----
        $(document).on('click','#edit_landmark',function(){
            var edit_id = $(this).data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                    url: "{{ url('/admin-editlandmarkForm') }}",
                    method: 'get',
                    data: {
                        '_token': $('input[name=_token]').val(),
                        'id' : edit_id
                    },
                    dataType: "json",
                    async: false,
                    success: function(result){
                        console.log(result)
                       if(result != '')
                       {
                        $('#nameTH').val(result.nameTH)
                        $('#nameEN').val(result.nameEN)
                        $('#id_landmark').val(result.id)
                        $('#price').val(result.priceTranspot);
                        $('#myModal').modal('show'); 
                       }
                       else alert('dont have data this landmark in database !!!');
                    }
            });
        });
        //--- end show data in modal ---
        //--- update data in modal ---
        $('#edit-submit').click(function(){
            var TH = $('form #nameTH').val();
            var EN = $('form #nameEN').val();
            var price = $('form #price').val();
            var id = $('form #id_landmark').val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                    url: "{{ url('/admin-editlandmark') }}",
                    method: 'post',
                    data:{
                        '_token': $('input[name=_token]').val(),
                        'id': id,
                        'nameTH': TH,
                        'nameEN': EN,
                        'priceTranspot' : price
                    },
                    dataType: "json",
                    async: false,
                    //beforeSend: function () { $('#overlay').css('display','') },
                    success: function(result){
                        $('#tr'+result.id).replaceWith('<tr id="tr'+result.id+'"><th scope="col">'+result.nameTH+'</th><th scope="col">'+result.nameEN+'</th> <th scope="col">'+
                        result.priceTranspot+'</th><th scope="col"><button class="btn btn-warning" id="edit_landmark" data-id="'+result.id+'"><i class="fas fa-edit fa-fw"></i></button> <button class="btn btn-danger" id="del_landmark" data-id="'+
                        result.id+'"><i class="fas fa-trash-alt fa-fw"></i></button></th>');
                        $('#myModal').modal('hide');
                    }
            });
        });
        //--- end up date ---
    });
        

</script>
@endsection