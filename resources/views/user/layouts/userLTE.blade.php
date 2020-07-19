<html lang={{config('app.locale')}} >
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">


  <title>{{ config('app.name') }} || @yield('title')</title>

  <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet"> <!--load all styles -->
  <link href="{{ asset('css/devices.min.css') }}" rel="stylesheet"> <!--load devices styles -->

  <meta name="csrf-token" content="{{ csrf_token() }}">


  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('/')}}/design/AdminLTE/dist/css/adminlte.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- bootstrap rtl -->
  <link rel="stylesheet" href="{{url('/')}}/css/bootstrap-rtl.min.css">
  <!-- template rtl version -->
  <link rel="stylesheet" href="{{url('/')}}/design/AdminLTE/dist/css/custom-style.css">



</head>
<body class="hold-transition sidebar-mini ">
    <!-- div show when submit -->
<div id="pageloader">
   <img src="{{url('/')}}/design/LandingPage/img/loading.gif" alt="processing..." />
</div>
    <div class="wrapper">

      <nav class="main-header navbar navbar-expand navbar-white navbar-light ">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>



</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ url('/') }}/img/logo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
      style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('/') }}/img/profile.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
          <a href="" target="_blank" class="d-block">
            لوحة التحكم

          </a>
      </div>
  </div>

  <!-- Sidebar Menu -->
  <nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <li class="nav-item">
        <a href="{{ route('home') }}" class="nav-link">
          <i class="nav-icon fas fa-magic"></i>

          <p>
              تصميمي
          </p>
      </a>
  </li>

  <li class="nav-item">
    <a href="{{ url('/imgs') }}" class="nav-link">
      <i class="nav-icon fas fa-image"></i>

      <p>
       مكتبة الصور

   </p>
</a>
</li>


<li class="nav-item">
    <a href="{{ url('profile') }}" class="nav-link">
      <i class="nav-icon fas fa-user"></i>

      <p>
       الملف الشخصي

   </p>
</a>
</li>






<li class="nav-item">
    <a class="nav-link"href=""
    onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
    <i class="fas fa-power-off"></i>

    <p>تسجيل خروج</p>

    <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</a>
</li>
</ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper ">

    <!-- Content Header (Page header) -->

    @yield('content')

    <!-- /.col-md-6 -->
</div>
<!-- /.row -->
</div><!-- /.container-fluid -->
</div>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->



<!-- Main Footer -->
<footer class="main-footer">
    <!-- Default to the left -->
    <h4 class="text-center">{{ config('app.name') }}</h4>
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->


<script defer src="{{ asset('js/fontawesome.js') }}"></script> <!--load all fontassowme styles -->
<!-- jQuery -->
<script src="{{url('/')}}/js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{url('/')}}/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{url('/')}}/design/AdminLTE/dist/js/adminlte.js"></script>
<script src="{{url('/')}}/design/AdminLTE/dist/js/custom.js"></script>


</body>
</html>
