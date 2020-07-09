
<html dir={{config('app.direction')}} lang={{config('app.locale')}}>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>{{ config('app.name') }}</title>

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
  <link rel="stylesheet" href="{{url('/')}}/css/bootstrap-rtl.min.css">

</head>
<body>

  <!-- Header Area wrapper Starts -->
  <header id="header-wrap">
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-md bg-inverse fixed-top scrolling-navbar">
      <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <a href="index.html" class="navbar-brand"><img src="{{url('/')}}/design/LandingPage/img/logo.png" alt=""></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <i class="lni-menu"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
          <ul class="navbar-nav mr-auto w-100 justify-content-end clearfix">
            <li class="nav-item active">
              <a class="nav-link" href="">
                جرب سوق
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
        <h6 class="text-center">جميع الحقوق محفوظة لسوق</h6>
    </div>
  </div>
  <!-- Copyright Section End -->

  <!-- Go to Top Link -->
  <a href="#" class="back-to-top">
    <i class="lni-arrow-up"></i>
  </a>

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
  <script src="{{url('/')}}/design/LandingPage/js/main.js"></script>


</body>
</html>
