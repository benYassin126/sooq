
<html dir={{config('app.direction')}} lang={{config('app.locale')}}>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>{{ config('app.name') }}</title>

  <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet"> <!--load all styles -->
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{url('/')}}/design/LandingPage/css/bootstrap.min.css" >
  <!-- Icon -->
  <link rel="stylesheet" href="{{url('/')}}/design/LandingPage/fonts/line-icons.css">
  <!-- Animate -->
  <link rel="stylesheet" href="{{url('/')}}/design/LandingPage/css/animate.css">
  <!-- Main Style -->
  <link rel="stylesheet" href="{{url('/')}}/design/LandingPage/css/main.css">
  <!-- Responsive Style -->
  <link rel="stylesheet" href="{{url('/')}}/design/LandingPage/css/responsive.css">
    <link href="{{ asset('css/devices.min.css') }}" rel="stylesheet"> <!--load devices styles -->
  <link rel="stylesheet"  href="{{url('/')}}/design/AdminLTE/plugins/iCheck/square/blue.css">
  <link rel="stylesheet" href="{{url('/')}}/css/bootstrap-rtl.min.css">
  <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
<!-- div show when submit -->
<div id="pageloader">
   <img src="{{url('/')}}/design/LandingPage/img/loading.gif" alt="processing..." />
</div>
<div id="pageloaderWhenDesign">
   <img src="{{url('/')}}/design/LandingPage/img/wait.png" alt="processing..." />
</div>
  <!-- Header Area wrapper Starts -->
  <header id="header-wrap">
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-md bg-inverse fixed-top scrolling-navbar">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <a href="{{ url('/') }}" class="navbar-brand"><img src="{{url('/')}}/design/LandingPage/img/logo.png" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <i class="lni-menu"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto w-100 justify-content-end clearfix">
            @guest
            <li class="nav-item">
              <a class="nav-link" href="{{ route('try') }}">
                جرب  {{ config('app.name') }}
            </a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">
            تسجيل جديد
        </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('login') }}">
        تسجيل دخول
    </a>
</li>
@endguest
@if (!Auth::guest())
<li class="nav-item">
  <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
      {{ __('Logout') }}
  </a>
  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>
</li>
@endif
</ul>
</div>
</div>
</nav>
<!-- Navbar End -->

@yield('content')

</header>
<!-- Header Area wrapper End -->

<!-- Copyright Section Start -->
<div class="copyright">
    <div class="container">
        <p class="text-center">جميع الحقوق محفوظة  ل{{ config('app.name')}}</p>
    </div>
</div>
<!-- Copyright Section End -->


<!-- Preloader -->
<div id="preloader">
    <div class="loader" id="loader-1"></div>
</div>
<!-- End Preloader -->

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{url('/')}}/js/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{url('/')}}/js/bootstrap.bundle.min.js"></script>
<script src="{{url('/')}}/design/LandingPage/js/wow.js"></script>
<script src="{{url('/')}}/design/LandingPage/js/jquery.nav.js"></script>
<script src="{{url('/')}}/design/LandingPage/js/jquery.easing.min.js"></script>
<script src="{{url('/')}}/design/LandingPage/js/jquery.slicknav.js"></script>
<script  src="{{url('/')}}/design/AdminLTE/plugins/iCheck/icheck.min.js"></script>

<script defer src="{{ asset('js/fontawesome.js') }}"></script> <!--load all fontassowme styles -->
<script src="{{url('/')}}/design/LandingPage/js/main.js"></script>


</body>
</html>
