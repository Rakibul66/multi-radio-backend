<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Admin | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('back/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('back/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css')}}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('back/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('back/plugins/jqvmap/jqvmap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('back/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('back/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('back/plugins/daterangepicker/daterangepicker.css')}}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('back/plugins/summernote/summernote-bs4.min.css')}}">

  <link rel="stylesheet" href="{{asset('custom/style.css')}}">

  <link rel="stylesheet" href="{{asset('custom/toastr.css')}}">

    <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('back/plugins/select2/css/select2.min.css')}}">

  <link rel="stylesheet" href="{{asset('back/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">

     <!-- Data Table Css -->
    <link rel="stylesheet" type="text/css" href="{{asset('back/datatable/css/dataTables.bootstrap4.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('back/datatable/css/buttons.dataTables.min.css')}}">
    
    <link rel="stylesheet" type="text/css" href="{{asset('back/datatable/css/responsive.bootstrap4.min.css')}}">


    
    <link rel="stylesheet" href="{{asset('dropify/dist/css/dropify.min.css')}}">


</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">


  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a href="{{URL::to('/logout')}}" class="btn btn-info">LOGOUT</a>
      </li>
       
      </li>


    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{URL::to('/dashboard')}}" class="brand-link">
      <img src="{{URL::to(setting()->app_logo)}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{setting()->app_name}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{URL::to(Auth::user()->image)}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
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
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{URL::to('/dashboard')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                
              </p>
            </a>
            
          </li>


          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Categories
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('categories.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('categories.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Category</p>
                </a>
              </li>
             
            </ul>
          </li>
          

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Countries
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('countries.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Country</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('countries.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Country</p>
                </a>
              </li>
             
            </ul>
          </li>


          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Radio
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('radios.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Radio</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('radios.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Radio</p>
                </a>
              </li>
             
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Social Media
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('socialmedia.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Social Media</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('socialmedia.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Social Media</p>
                </a>
              </li>
             
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Schedule
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('schedule.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Schedule</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('schedule.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Schedules</p>
                </a>
              </li>
             
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Podcast
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('podcast.create')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Podcast</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('podcast.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Podcasts</p>
                </a>
              </li>
             
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('/app-settings')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>App Settings</p>
                </a>
              </li>


              <li class="nav-item">
                <a href="{{url('/ads-settings')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ads Settings</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{url('/account-settings')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Account Settings</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{url('/change-password')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li>
             
            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

   @yield('content')


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('custom/custom_js.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('back/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('back/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>


<script src="{{asset('custom/custom.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('back/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('back/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('back/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('back/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('back/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('back/dist/js/adminlte.js')}}"></script>

<!-- Select2 -->
<script src="{{asset('back/plugins/select2/js/select2.full.min.js')}}"></script>

<!-- data-table js -->
<script src="{{asset('back/datatable/js/jquery.dataTables.min.js')}}"></script>

<script src="{{asset('back/datatable/js/dataTables.buttons.min.js')}}"></script>



<script src="{{asset('back/datatable/js/dataTables.bootstrap4.min.js')}}"></script>

<script src="{{asset('back/datatable/js/dataTables.responsive.min.js')}}"></script>

<script src="{{asset('back/datatable/js/responsive.bootstrap4.min.js')}}"></script>

<script src="{{asset('back/datatable/js/data-table-custom.js')}}"></script>

<script src="{{asset('dropify/dist/js/dropify.min.js')}}"></script>



<script>
  $(function () {
    $('#summernote').summernote();

    var base_url = "{{url('/')}}";
    localStorage.setItem('base_url', base_url);
 
  })
</script>


<script src="{{asset('custom/toastr.js')}}"></script>
 
  @if(Session::has('messege'))
    @toastr("{{ Session::get('messege') }}")
  @endif
  

</body>
</html>
