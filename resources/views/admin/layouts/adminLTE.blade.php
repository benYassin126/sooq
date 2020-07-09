
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="ar">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">


  <title>{{ config('app.name') }} || @yield('title')</title>

  <link href="{{ asset('css/all.css') }}" rel="stylesheet"> <!--load all styles -->
  <link href="{{ asset('css/devices.min.css') }}" rel="stylesheet"> <!--load devices styles -->

  <meta name="csrf-token" content="{{ csrf_token() }}">


  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('/')}}/design/AdminLTE/dist/css/adminlte.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- bootstrap rtl -->
  <link rel="stylesheet" href="{{url('/')}}/design/AdminLTE/dist/css/bootstrap-rtl.min.css">
  <!-- template rtl version -->
  <link rel="stylesheet" href="{{url('/')}}/design/AdminLTE/dist/css/custom-style.css">



</head>
<body class="hold-transition sidebar-mini ">
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
        <a href="" class="nav-link">
          <i class="nav-icon fas fa-tachometer-alt"></i>

          <p>
              نظرة عامة
          </p>
      </a>
  </li>

  <li class="nav-item">
    <a href="{{ route('user.index') }}" class="nav-link">
      <i class="nav-icon fas fa-user"></i>

      <p>
       العملاء

   </p>
</a>
</li>


<li class="nav-item">
    <a href="" class="nav-link">
      <i class="nav-icon fas fa-briefcase"></i>

      <p>
       الباقات

   </p>
</a>
</li>

<li class="nav-item">
    <a href="" class="nav-link">
        <i class="fas fa-flag"></i>

        <p>
           الاشتراكات
       </p>
   </a>

</li>

<li class="nav-item has-treeview">
  <a href="" class="nav-link">
    <i class="nav-icon fa fa-table"></i>
    <p>
      القوالب
      <i class="fa fa-angle-left right"></i>
  </p>
</a>
<ul class="nav nav-treeview">
    <li class="nav-item">
      <a  href="{{ route('template.index') }}" class="nav-link">
        <i class="fa fa-border-all nav-icon"></i>
        <p>قوالب النظام</p>
    </a>
</li>
<li class="nav-item">
  <a href="pages/tables/data.html" class="nav-link">
    <i class="fa fa-cog nav-icon"></i>

    <p>التحكم بالقوالب </p>
    <span class="right badge badge-danger">قريبا</span>
</a>
</li>

</ul>
</li>



<li class="nav-item">
    <a class="nav-link"href=""
    onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
    <i class="fas fa-power-off"></i>

    <p>تسجيل خروج</p>

    <form id="logout-form" action="{{ url('admin/logout') }}" method="POST" style="display: none;">
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


<script defer src="{{ asset('js/all.js') }}"></script> <!--load all fontassowme styles -->
<!-- jQuery -->
<script src="{{url('/')}}/design/AdminLTE/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{url('/')}}/design/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{url('/')}}/design/AdminLTE/dist/js/adminlte.js"></script>
<script src="{{url('/')}}/design/AdminLTE/dist/js/custom.js"></script>

<script type="text/javascript">





    //To Ajax Search
    $('#search').on('keyup',function(){

        $value=$(this).val();
        $.ajax({
            type : 'get',
            url : '{{URL::to('admin/user.search')}}',
            data:{'search':$value},
            success:function(data){
                $('tbody').html(data);
            }
        });
    })


</script>

<script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>

</body>
</html>
