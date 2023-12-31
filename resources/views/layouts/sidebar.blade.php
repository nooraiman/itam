<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="/" class="brand-link">
      <img src="{{url('/')}}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">ITAM</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
              <img src="{{url('/')}}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
              <a href="#" class="d-block">{{auth()->user()->name}}</a>
          </div>
      </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
          <a href="{{route('dashboard')}}" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        @if(auth()->user()->hasRole('admin'))
        <li class="nav-item">
          <a href="{{route('assets.index')}}" class="nav-link">
            <i class="nav-icon fas fa-laptop"></i>
            <p>
              Assets
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link">
            <i class="nav-icon fa fa-fw fa-gear"></i>
            <p>
              Settings
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{ route('models.index') }}" class="nav-link">
              <i class="fas fa-fw fa-list"></i>
              <p>Asset Models</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('categories.index') }}" class="nav-link">
              <i class="fa-solid fa-hashtag "></i>
              <p>Asset Categories</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{ route('manufacturers.index') }}" class="nav-link">
              <i class="fa-solid fa-industry"></i>
              <p>Manufacturers</p>
              </a>
            </li>
          </ul>
          @endif

        </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>