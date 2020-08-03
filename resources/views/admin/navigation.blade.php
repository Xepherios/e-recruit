<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
      <!-- Toggler -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <!-- Brand -->
      <a class="navbar-brand pt-0" href="#">
        <img src="{{ url('assets/img/brand/blue.png') }}" class="navbar-brand-img" alt="...">
      </a> 
      <!-- Collapse -->
      <div class="collapse navbar-collapse" id="sidenav-collapse-main">
        <!-- Collapse header -->
        <div class="navbar-collapse-header d-md-none">
          <div class="row">
            <div class="col-6 collapse-brand">
              <a href="#">
                <img src="{{ url('assets/img/brand/blue.png') }}">
              </a>
            </div>
            <div class="col-6 collapse-close">
              <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                <span></span>
                <span></span>
              </button>
            </div>
          </div>
        </div>
        <!-- Form -->
        <form class="mt-4 mb-3 d-md-none">
          <div class="input-group input-group-rounded input-group-merge">
            <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
            <div class="input-group-prepend">
              <div class="input-group-text">
                <span class="fa fa-search"></span>
              </div>
            </div>
          </div>
        </form>
        <!-- Navigation -->
        <ul class="navbar-nav"> 
            <a class="nav-link @if ($current_menu == 'dashboard') active @endif" href="{{url('/admin')}}"> 
                <i class="ni ni-chart-pie-35 text-primary"></i> แดชบอร์ด
            </a> 
          </li>
          <li class="nav-item">
            <a class="nav-link @if ($current_menu == 'applications') active @endif" href="{{url('/admin/applications')}}">
              <i class="ni ni-paper-diploma text-primary"></i> ใบสมัครงาน
            </a>
          </li>
          <li class="nav-item">
              <a class="nav-link @if ($current_menu == 'departments') active @endif" href="{{url('/admin/departments')}}">
                <i class="ni ni-folder-17 text-primary"></i> แผนก
              </a>
            </li>
          <li class="nav-item">
            <a class="nav-link @if ($current_menu == 'positions') active @endif" href="{{url('/admin/positions')}}">
              <i class="ni ni-bullet-list-67 text-primary"></i> ตำแหน่งงาน
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if ($current_menu == 'admins') active @endif" href="{{url('/admin/users')}}">
              <i class="ni ni-circle-08 text-primary"></i> ผู้ดูแลระบบ
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if ($current_menu == 'logout') active @endif" href="{{url('/admin/logout')}}">
              <i class="ni ni-lock-circle-open text-primary"></i> ออกจากระบบ
            </a>
          </li>
        </ul> 
      </div>
    </div>
  </nav>