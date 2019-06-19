<ul class="sidebar navbar-nav">
        <li class="nav-item" id="admin">
          <a class="nav-link" href="{{url('/admin')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="nav-item dropdown" id="car">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Car</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Car Manager:</h6>
            <a class="dropdown-item" href="{{url('/admin-listcar')}}">List Car</a>
            <a class="dropdown-item" href="{{url('/admin-addcar')}}">Add Car</a>
            <a class="dropdown-item" href="{{url('/admin-brand')}}">Brand Car</a>
            <a class="dropdown-item" href="{{url('/admin-model')}}">Model Car</a>
            <a class="dropdown-item" href="{{url('/admin-type')}}">Type Car</a>
            <a class="dropdown-item" href="{{url('/admin-time')}}">Time Rent Car</a>
            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Other Pages:</h6>
            <a class="dropdown-item" href="{{url('/admin-returncar')}}">Return Car</a>
            <a class="dropdown-item" href="blank.html">Blank Page</a>
          </div>
        </li>
        <li class="nav-item" id="landmark">
          <a class="nav-link" href="{{url('/admin-landmark')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Landmark</span></a>
        </li>
        <li class="nav-item" id="attraction">
          <a class="nav-link" href="{{url('/admin-attraction')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Attraction</span></a>
        </li>
        <li class="nav-item dropdown" id="book">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Book</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Book Manager:</h6>
            <a class="dropdown-item" href="{{url('/admin-confirm-book')}}">Book Confirm</a>
            <a class="dropdown-item" href="{{url('/admin-confirm-pdf')}}">Book PDF</a>
            <a class="dropdown-item" href="{{url('/admin-confirm-success')}}">Book Success</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
        </li>
      </ul>