<!-- Modal -->
<div class="modal fade" id="LoginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content text-white border" style="background-color: rgba(0, 0, 0, 0.7);">
      <div class="modal-header text-center">
        <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-group"></i> Login</h4>
        <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true" class="text-danger">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form action="{{action('LoginController@login')}}" method="POST">
          {{ csrf_field() }}
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email">
          </div>
          <div class="form-group mb-4">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" name="password" placeholder="Password">
          </div>
          <button type="submit" class="btn btn-primary btn-block">Login</button>
          <div class="row mt-4 border-top">
            <div class="col text-center">
              <h5>Login with</h5>
              <div class="row">
                <div class="col">
                  <a href="{{action('LoginController@redirectToFacebookProvider')}}" class="btn btn-block border text-center text-white" role="button" style="background:none;">
                      <img src="{{asset('img/fb-logo.png')}}" alt="" style="weight:50px; height:50px;"> Facebook
                  </a>
                </div>
                <div class="col">
                    <a href="{{action('LoginController@redirectToGoogleProvider')}}" class="btn btn-block border text-center text-white" role="button" style="background:none;">
                        <img src="{{asset('img/gg-logo.png')}}" alt="" style="weight:50px; height:50px;"> Google
                    </a>
                </div>
              </div>
            </div>
          </div>
      </div>
    </form>
      <div class="modal-footer">
        <a href="" class="btn btn-primary" role="button" >Register</a>
      </div>
    </div>
  </div>
</div>