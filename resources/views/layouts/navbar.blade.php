<nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color:#B2D732">
    <a class="navbar-brand" href="#"><img src="{{asset('img/logo.png')}}" alt="" width="auto" height="50px" id="logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  @if (Session::get('language') == 'en')
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item"><a class="nav-link" href="#">Link</a></li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Dropdown
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">disabled</a>
        </li>
      </ul>
      @if (Auth::user())
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  {{Auth::user()->name}}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#">Action</a>
                  <a class="dropdown-item" href="#">Another action</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{action('LogoutController@logout')}}">Logout</a>
                </div>
              </li>
              <li class="nav-item language">
                  <a class="nav-link" href="{{action('IndexController@index')}}"><img src="{{asset('img/thailand.png')}}" alt="" width="100%" height="25px"></a>
              </li>
              <li>
                  <a class="nav-link" href="#">/</a>
              </li>
              <li class="nav-item language">
                  <a class="nav-link" href="{{action('IndexController@indexEN')}}"><img src="{{asset('img/usa.png')}}" alt="" width="100%" height="25px"></a>
              </li>
        </ul>
      @else
      <ul class="navbar-nav ml-auto">
       
        <li class="nav-item">
            <a class="nav-link" id="user" href="#" data-toggle="modal" data-target="#LoginModal" role="button" ><i class="fa fa-group"> Login</i></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id='company' href="#" data-toggle="modal" data-target="#RegisModal" role="button"><i class="fa fa-building"> Register</i></a>
          </li>
          <li class="nav-item language">
              <a class="nav-link" href="{{action('IndexController@index')}}"><img src="{{asset('img/thailand.png')}}" alt="" width="100%" height="25px"></a>
          </li>
          <li>
              <a class="nav-link" href="#">/</a>
          </li>
          <li class="nav-item">
              <a class="nav-link language" href="{{action('IndexController@indexEN')}}"><img src="{{asset('img/usa.png')}}" alt="" width="100%" height="25px"></a>
          </li>
      </ul>
      @endif
    </div>
  @else

   {{-- Thai language --}}
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="{{url('/')}}">หน้าหลัก <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item"><a class="nav-link" href="{{action('CarController@carshowform')}}">สินค้า</a></li>
        <li class="nav-item"><a class="nav-link" href="{{action('PaymentController@howtopayment')}}">แจ้งชำระเงิน</a></li>
        <li class="nav-item"><a class="nav-link" href="{{action('IndexController@howto')}}">วิธีการสั่งซื้อสินค้า</a></li>
        <li class="nav-item"><a class="nav-link" href="#">สถานที่สำคัญของเชียงใหม่</a></li>
      </ul>
      @if (Auth::user())
        <ul class="navbar-nav ml-auto">
            <form class="form-inline my-2 my-lg-0" action="{{action('SearchController@searchBook')}}" method="GET">
                <input class="form-control mr-sm-2" type="search" placeholder="Enter Name" aria-label="Search" name="search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">search</button>
              </form>  
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                  aria-haspopup="true" aria-expanded="false">
                  {{Auth::user()->name}}
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="#"></a>
                  <a class="dropdown-item" href="{{action('UserController@view_profile')}}">แก้ไขประวัติส่วนตัว</a>
                  <div class="dropdown-divider"></div>
                  @if (Auth::user()->isAdmin == 1)
                  <a class="dropdown-item" href="{{action('Admin\IndexController@Index')}}">admin</a>
                  @endif
                  <a class="dropdown-item" href="{{action('LogoutController@logout')}}">ออกจากระบบ</a>
                </div>
              </li>
            <li class="nav-item language">
                <a class="nav-link" href="{{action('IndexController@index')}}"><img src="{{asset('img/thailand.png')}}" alt="" width="100%" height="25px"></a>
            </li>
            <li>
                <a class="nav-link" href="#">/</a>
            </li>
            <li class="nav-item language">
                <a class="nav-link" href="{{action('IndexController@indexEN')}}"><img src="{{asset('img/usa.png')}}" alt="" width="100%" height="25px"></a>
            </li>
        </ul>
      @else
      <form class="form-inline my-2 my-lg-0" action="{{action('SearchController@searchBook')}}" method="GET">
          <input class="form-control mr-sm-2" type="search" placeholder="Enter Name" aria-label="Search" name="search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">search</button>
        </form>  
      <ul class="navbar-nav">
       
          <li class="nav-item">
              <a class="nav-link" id="user" href="#" data-toggle="modal" data-target="#LoginModal" role="button" ><i class="fa fa-group"> เข้าสู่ระบบ</i></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id='company' href="#" data-toggle="modal" data-target="#RegisModal" role="button"><i class="fa fa-building"> สมัครสมาชิก</i></a>
            </li>
            <li class="nav-item language">
                <a class="nav-link" href="{{action('IndexController@index')}}"><img src="{{asset('img/thailand.png')}}" alt="" width="100%" height="25px"></a>
            </li>
            <li>
                <a class="nav-link" href="#">/</a>
            </li>
            <li class="nav-item language">
                <a class="nav-link" href="{{action('IndexController@indexEN')}}"><img src="{{asset('img/usa.png')}}" alt="" width="100%" height="25px"></a>
            </li>
        </ul>
      @endif
    </div>
  @endif
    
  </nav> 