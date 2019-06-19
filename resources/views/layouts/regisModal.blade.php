<!-- Modal -->
<div class="modal fade" id="RegisModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content text-white border" style="background-color: rgba(0, 0, 0, 0.7);">
            <div class="modal-header">
              <h4 class="modal-title" id="exampleModalLabel"><i class="fa fa-user-plus"></i> Register</h4>
              <button type="button" class="close btn-danger" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true" class="text-danger">&times;</span>
              </button>
            </div>
            <div class="modal-body">
      
              <form action="{{action('RegisController@register')}}" method="POST">
                {{ csrf_field() }}
                <div class="row">
                  <div class="col">
                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-envelope fa-fw"></i></span>
                          </div>
                          <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="Enter email" required value="{{old('email')}}">
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-lock fa-fw"></i></span>
                          </div>
                          <input type="password" class="form-control" name="password" placeholder="Password" required>
                      </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-lock fa-fw"></i></span>
                          </div>
                          <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                      </div>
                      @if ($errors->has('password'))
                        <span>
                            <ul>
                                <li><small>password has less 6 little up !!!</small></li>
                                <li><small>Or Confirm password Invalid !!!</small></li>
                              </ul>
                        </span>
                      @endif
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                      <div class="input-group mb-3">
                          <div class="input-group-prepend">
                              <span class="input-group-text"><i class="fa fa-id-card fa-fw"></i></span>
                          </div>
                          <input type="text" class="form-control" name="fname" placeholder="First Name" required value="{{old('fname')}}">
                      </div>
                      @if ($errors->has('fname'))
                      <span>
                          <ul>
                              <li><small>please Enter Name<small></li>
                          </ul>
                      </span>
                    @endif
                  </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-id-card fa-fw"></i></span>
                            </div>
                            <input type="text" class="form-control" name="lname" placeholder="Last Name" required value="{{old('lname')}}">
                        </div>
                        @if ($errors->has('lname'))
                        <span>
                            <ul>
                                <li><small>please Enter Name<small></li>
                            </ul>
                        </span>
                      @endif
                    </div>
                  </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </div>
          </form>
          </div>
        </div>
      </div>