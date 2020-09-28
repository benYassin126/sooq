<html dir={{config('app.direction')}} lang={{config('app.locale')}}>
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-173944302-1"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-173944302-1');
        </script>
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
            <div class="contentWhenDesign text-center">
                <div id="typed-strings">
                    <p>لا تبحث عن زبائن لمنتجاتك. ابحث عن منتجات لزبائنك  <strong>سيث جودين</strong></p>
                    <p>المحتوى هو الملك. <strong>بيل جيتس</strong></p>
                    <p>يجب أن تعطي زبائنك ما يحتاجونه فعلا، لا ما تظن أنهم يحتاجونه. <strong>جون إيلان</strong></p>
                    <p>الإعلان لا يصنع ميزة للمنتج ، انه فقط وسيلة لإعلام الناس بها<strong> بيل بيرنباخ</strong></p>
                    <p>كلما كان المنتج أفضل، كلما قلت أموالك المدفوعة فى الإعلان <strong>فيليب كوتلر</strong></p>
                    <p>التسويق سباق بدون خط نهاية <strong>فيليب كوتلر</strong></p>
                </div>

                <span id="typed"></span>
                <p class="mt-4">جاري التصميم</p>
                <div class="progress mt-2" style="width: 50%">

                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 10%"></div>
                </div>
            </div>
        </div>
        <!--====== PRELOADER PART START ======-->
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
                                                @guest
                                                <li class="nav-item active">
                                                    <a class="page-scroll" href="{{ url('/') }}">الصفحة الرئيسية</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="page-scroll" href="{{ route('register') }}">تسجيل جديد</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="page-scroll" href="{{ route('login') }}">تسجيل دخول</a>
                                                </li>
                                                </ul> <!-- navbar nav -->
                                            </div>
                                            <div class="navbar-btn ml-20 d-none d-sm-block">
                                                <a class="main-btn" href="{{ url('try') }}"><i class="lni lni-heart"> </i> جرب   {{ config('app.name') }}  مجاناٌ</a>
                                            </div>
                                            <div class="navbar-btn ml-20 d-none d-sm-block">
                                                <a class="main-btn" target="_blank" href="https://api.whatsapp.com/send?phone=966552300079"><i class="lni-whatsapp ml-2"></i>0552300079</a>
                                            </div>
                                            @endguest
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
                                                            <a target="_blank" href="https://maroof.sa/147949">
                                                                <img width="65px" height="30px"  src="https://niceonesa.com/_nuxt/img/7faf3e6.png">
                                                            </a>
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
                                                    <!--====== Aos js ======-->
                                                    <!--====== Typed js ======-->
                                                    <script src="{{url('/')}}/design/LandingPage/js/typed.js"></script>
                                                    <script defer src="{{ asset('js/fontawesome.js') }}"></script>
                                                     <!--load all fontassowme styles -->
                                                    <!--====== Main js ======-->
                                                    <script src="{{url('/')}}/design/LandingPage/js/main.js"></script>
                                                    <script src="//code.tidio.co/aaui0ro9xrcz6iprtyahopicsoeyp9cb.js" async></script>
                                                </body>
                                            </html>
