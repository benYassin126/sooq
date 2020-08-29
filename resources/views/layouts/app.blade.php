
<html dir={{config('app.direction')}} lang={{config('app.locale')}}>

<head>
    <!--====== Required meta tags ======-->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--====== Title ======-->
    <title>{{ config('app.name') }}</title>

  <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet"> <!--load all styles -->
    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{url('/')}}/design/LandingPage/images/favicon.png" type="image/png">

    <!--====== Bootstrap css ======-->
    <link rel="stylesheet" href="{{url('/')}}/design/LandingPage/css/bootstrap.min.css">

    <!--====== Bootstrap RTL css  ======-->
    <link rel="stylesheet" href="{{url('/')}}/design/LandingPage/css/bootstrap-rtl.min.css">

    <!--====== Fontawesome css ======-->
    <link rel="stylesheet" href="{{url('/')}}/design/LandingPage/css/font-awesome.min.css">

    <!--====== Line Icons css ======-->
    <link rel="stylesheet" href="{{url('/')}}/design/LandingPage/css/LineIcons.css">

    <!--====== Animate css ======-->
    <link rel="stylesheet" href="{{url('/')}}/design/LandingPage/css/animate.css">

    <!--====== Aos css ======-->
    <link rel="stylesheet" href="{{url('/')}}/design/LandingPage/css/aos.css">

    <!--====== Slick css ======-->
    <link rel="stylesheet" href="{{url('/')}}/design/LandingPage/css/slick.css">

    <!--====== Default css ======-->
    <link rel="stylesheet" href="{{url('/')}}/design/LandingPage/css/default.css">

    <!--====== Style css ======-->
    <link rel="stylesheet" href="{{url('/')}}/design/LandingPage/css/style.css">
    <!--====== Style css ======-->
    <link rel="stylesheet" href="{{url('/')}}/design/LandingPage/css/responsive.css">


    <link rel="stylesheet"  href="{{url('/')}}/design/AdminLTE/plugins/iCheck/square/blue.css">
    <link href="{{ asset('css/devices.min.css') }}" rel="stylesheet"> <!--load devices styles -->

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
<!-- div show when submit -->
<div id="pageloader">
   <img src="{{url('/')}}/design/LandingPage/images/loading.gif" alt="processing..." />
</div>
<div id="pageloaderWhenDesign">
   <img src="{{url('/')}}/design/LandingPage/images/wait.png" alt="processing..." />
</div>
    <!--====== PRELOADER PART START ======-->

    <div class="preloader">
        <div class="loader_34">
            <div class="ytp-spinner">
                <div class="ytp-spinner-container">
                    <div class="ytp-spinner-rotator">
                        <div class="ytp-spinner-left">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                        <div class="ytp-spinner-right">
                            <div class="ytp-spinner-circle"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--====== PRELOADER ENDS START ======-->

    <!--====== HEADER PART START ======-->

    <header id="home" class="header-area pt-100">



        <div class="shape header-shape-tow animation-one">
            <img src="{{url('/')}}/design/LandingPage/images/banner/shape/shape-2.png" alt="shape">
        </div> <!-- header shape tow -->

        <div class="shape header-shape-three animation-one">
            <img src="{{url('/')}}/design/LandingPage//images/banner/shape/shape-3.png" alt="shape">
        </div> <!-- header shape three -->
        <div class="navigation-bar">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="{{ url('/') }}">
                                <img src="{{url('/')}}/design/LandingPage/images/logo.png" alt="Logo">
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                                <span class="toggler-icon"></span>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul id="nav" class="navbar-nav ml-auto">
                                    @if(Auth::guest())
                                    <li class="nav-item active">
                                        <a class="page-scroll" href="{{ url('/') }}">الصفحة الرئيسية</a>
                                    </li>
                                     <li class="nav-item">
                                        <a class="page-scroll" href="{{ route('register') }}">تسجيل جديد</a>
                                    </li>
                                     <li class="nav-item">
                                        <a class="page-scroll" href="{{ route('login') }}">تسجيل دخول</a>
                                    </li>
                                    @endif
                                </ul> <!-- navbar nav -->
                            </div>
                             @guest
                            <div class="navbar-btn ml-20 d-none d-sm-block">
                                <a class="main-btn" href="{{ url('try') }}"><i class="lni-whatsapp ml-2"></i>جرب   {{ config('app.name') }}</a>
                            </div>
                            @endguest
                            <div class="navbar-btn ml-20 d-none d-sm-block">
                                <a class="main-btn" target="_blank" href="https://api.whatsapp.com/send?phone=966552300079"><i class="lni-whatsapp ml-2"></i>0552300079</a>
                            </div>
                        </nav> <!-- navbar -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- navigation bar -->

        @yield('content')


    <!--====== FOOTER PART START ======-->
        <div class="copyright-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright text-center">
                            <p>جميع الحقوق محفوظة  سوّق</p>
                        </div> <!-- copyright -->
                    </div>
                </div> <!-- row -->
            </div> <!-- container -->
        </div> <!-- copyright-area -->
    </footer>

    <!--====== FOOTER PART ENDS ======-->



    <!--====== PART START ======-->

    <!--
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-"></div>
            </div>
        </div>
    </section>
-->

    <!--====== PART ENDS ======-->


    <!-- row -->









    <!--====== jquery js ======-->
    <script src="{{url('/')}}/design/LandingPage/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="{{url('/')}}/design/LandingPage/js/vendor/jquery-1.12.4.min.js"></script>

    <!--====== Bootstrap js ======-->
    <script src="{{url('/')}}/design/LandingPage/js/bootstrap.min.js"></script>

    <!--====== WOW js ======-->
    <script src="{{url('/')}}/design/LandingPage/js/wow.min.js"></script>

    <!--====== Slick js ======-->
    <script src="{{url('/')}}/design/LandingPage/js/slick.min.js"></script>

    <!--====== Scrolling Nav js ======-->
    <script src="{{url('/')}}/design/LandingPage/js/scrolling-nav.js"></script>
    <script src="{{url('/')}}/design/LandingPage/js/jquery.easing.min.js"></script>

    <!--====== Aos js ======-->
    <script src="{{url('/')}}/design/LandingPage/js/aos.js"></script>
<script defer src="{{ asset('js/fontawesome.js') }}"></script> <!--load all fontassowme styles -->

    <!--====== Main js ======-->
    <script src="{{url('/')}}/design/LandingPage/js/main.js"></script>

<script src="//code.tidio.co/aaui0ro9xrcz6iprtyahopicsoeyp9cb.js" async></script>

</body>

</html>
