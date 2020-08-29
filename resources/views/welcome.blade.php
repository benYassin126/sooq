@extends('layouts.app')

@section('content')

        <div class="header-banner d-flex align-items-center mt-30">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-sm-12 ">
                        <div class="banner-content">
                            <h4 class="sub-title wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="1s">ياهلا فيك</h4>
                            <h1 class="banner-title mt-10 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="2s"><span>سّوق  </span> .. اصنع محتوى شهر في دقيقة !</h1>
                            <a class="main-btn mt-25 wow fadeInUp mb-4" data-wow-duration="1.5s" data-wow-delay="2.3s" href="{{ route('try') }}">جرب سوّق</a>

                        </div> <!-- banner content -->
                    </div>
                    <div class="col-xl-6 col-lg-6 col-sm-12 mb-2">
                        <img style="width: 80%;" src="{{url('/')}}/design/LandingPage/images/banner/banner-image.png">
                    </div>
                </div> <!-- row -->
            </div> <!-- container  -->

        </div> <!-- header banner -->

    </header>



    <!--====== HEADER PART ENDS ======-->
    <hr>
    <!--====== ABOUT PART START ======-->

    <section id="about" class="about-area pt-80 pb-130">
        <div class="section-title text-center pb-20">
              <h2 class="title">كيف ممكن يفيدني سوق ؟</h2>
        </div> <!-- section title -->
        <div class="container">
            <div class="row">

                <div class="col-lg-6">
                    <div class="about-image mt-50 clearfix">
                        <div class="single-image float-left">
                            <h4 class="text-center mb-2">قبل</h4>
                            <img src="{{url('/')}}/design/LandingPage/images/about/about-1.png" alt="About">
                        </div> <!-- single image -->
                        <div class="single-image image-tow float-right">
                            <h4 class="text-center ml-100 mb-2">بعد</h4>
                            <img src="{{url('/')}}/design/LandingPage/images/about/about-2.png" alt="About">
                        </div> <!-- single image -->
                    </div> <!-- about image -->
                </div>
                <div class="col-lg-6">

                    <div class="about-content mt-45">

                        <h4 class="about-welcome">سوق هو</h4>
                        <h3 class="about-title mt-10">
                            عبارة عن منصة تساعدك على صناعة محتوى رائع لمنصات التواصل الاجتماعي وخلال مدة زمنية قصيرة</h3>
                                              <a class="main-btn mt-25 " href="#">جرب سوّق</a>
                    </div> <!-- about content -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== ABOUT PART ENDS ======-->

    <!--====== SERVICES PART START ======-->

    <section id="service" class="services-area pt-125 pb-130 gray-bg">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center pb-20">
                        <h5 class="sub-title mb-15">مميزات سوق</h5>
                        <h2 class="title">وش يقدم سوّق</h2>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="single-services text-center mt-30 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.4s">
                        <div class="services-icon">
                            <i class="lni-paint-roller"></i>
                        </div>
                        <div class="services-content mt-15">
                            <h4 class="services-title">سهولة بناء المحتوى</h4>
                            <p class="mt-20">خلال دقائق معدودة وبخطوات بسيطة تستطيع الوصول لمحتوى رائع وجذااب</p>
                        </div>
                    </div> <!-- single services -->
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="single-services text-center mt-30 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.8s">
                        <div class="services-icon">
                            <i class="lni-blackboard"></i>
                        </div>
                        <div class="services-content mt-15">
                            <h4 class="services-title">تصاميم رائعة</h4>
                            <p class="mt-20">بعد التسجيل والوصول للمحتوى .. تستطيع الرجوع للمحتوى في اي وقت</p>
                        </div>
                    </div> <!-- single services -->
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="single-services text-center mt-30 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="1.2s">
                        <div class="services-icon">
                            <i class="lni-home"></i>
                        </div>
                        <div class="services-content mt-15">
                            <h4 class="services-title">الوصول الدائم للمحتوى</h4>
                            <p class="mt-20">بعد التسجيل والوصول للمحتوى .. تستطيع الرجوع للمحتوى في اي وقت</p>
                        </div>
                    </div> <!-- single services -->
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="single-services text-center mt-30 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.4s">
                        <div class="services-icon">
                            <i class="lni-briefcase"></i>
                        </div>
                        <div class="services-content mt-15">
                            <h4 class="services-title">دعم فني لا متناهي</h4>
                            <p class="mt-20">في حال احتجت للدعم الفني .. حنا متواجدين على مدار الساعة</p>
                        </div>
                    </div> <!-- single services -->
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="single-services text-center mt-30 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.8s">
                        <div class="services-icon">
                            <i class="lni-handshake"></i>
                        </div>
                        <div class="services-content mt-15">
                            <h4 class="services-title">ضمان الوصول لمحتوى جذاب</h4>
                            <p class="mt-20">تضمنلك سوّق وصولك لمحتوى جذاب يروق لعملائك</p>
                        </div>
                    </div> <!-- single services -->
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="single-services text-center mt-30 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="1.2s">
                        <div class="services-icon">
                            <i class="lni-grow"></i>
                        </div>
                        <div class="services-content mt-15">
                            <h4 class="services-title">بناء محتوى مخصص بهويتك التجارية  </h4>
                            <p class="mt-20">تتميز تصاميم سوق بأنها موافقة لهويتك الإعلامية</p>
                        </div>
                    </div> <!-- single services -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== SERVICES PART ENDS ======-->


    <!--====== START Price ======-->

<h2 class="title text-center mt-30 mb-4 ">باقات سوّق</h2>
<div class="pricing-table">

  <div class="pricing-item">
    <div class="pricing-title pt-4 pb-2" >
      <h3 class="MineColor">الأساسي</h3>
    </div>
    <div class="pricing-value">50SR
      <span class="undertext">شهريا</span>
    </div>
    <ul class="pricing-features">
      <li><span class="keywords">12 </span> تصميم مميز </li>
      <li><span class="keywords">12 </span> تصميم مميز </li>
      <li><span class="keywords">12 </span> تصميم مميز </li>
    </ul>
    <div class="buttonP">شراء</div>
  </div>

  <div class="pricing-item pricing-featured">
    <div class='selected'>مميز</div>
    <div class="pricing-title pt-4 pb-2" >
      <h3 class="MineColor">الذهبي</h3>
    </div>
    <div class="pricing-value">150SR
      <span class="undertext">شهريا</span>
    </div>
    <ul class="pricing-features">
      <li><span class="keywords">18 </span> تصميم مميز </li>
      <li><span class="keywords">18 </span> تصميم مميز </li>
      <li><span class="keywords">18 </span> تصميم مميز </li>
    </ul>
    <div class="buttonP">شراء</div>
  </div>

</div>
    <!--====== END Price ======-->


    <!--====== TEAM PART START ======-->

    <section id="team" class="team-area pt-125 pb-130">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center pb-20">
                        <h2 class="title mt-0">عملاء سوق</h2>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-team text-center mt-30 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.4s">
                        <div class="team-image">
                            <img src="{{url('/')}}/design/LandingPage/images/team/team-1.png" alt="Team">
                        </div>
                        <div class="team-content">
                            <h4 class="team-name"><a target="_blank" href="https://www.instagram.com/falafelpie_q/">فطيرة الفلافل</a></h4>
                            <ul class="social mt-25">
                                <li><a target="_blank" href="https://www.instagram.com/falafelpie_q/"><i class="lni-instagram-filled"></i></a></li>
                            </ul>
                        </div>
                    </div> <!-- single team -->
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-team text-center mt-30 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="0.8s">
                        <div class="team-image">
                            <img src="{{url('/')}}/design/LandingPage/images/team/team-2.png" alt="Team">
                        </div>
                        <div class="team-content">
                            <h4 class="team-name"><a target="_blank" href="https://salla.sa/chicbody/">chic body</a></h4>
                        </div>
                    </div> <!-- single team -->
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-team text-center mt-30 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="1.2s">
                        <div class="team-image">
                            <img src="{{url('/')}}/design/LandingPage/images/team/team-3.png" alt="Team">
                        </div>
                        <div class="team-content">
                            <h4 class="team-name"><a target="_blank" href="https://twitter.com/raisoon1986">ريسون للتسويق</a></h4>
                        </div>
                    </div> <!-- single team -->
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="single-team text-center mt-30 wow fadeInUp" data-wow-duration="1.5s" data-wow-delay="1.6s">
                        <div class="team-image">
                            <img src="{{url('/')}}/design/LandingPage/images/team/team-4.png" alt="Team">
                        </div>
                        <div class="team-content">
                            <h4 class="team-name"><a target="_blank" href="https://nersian.com.sa/">نرسيان للتمور</a></h4>
                            <ul class="social mt-25">
                                <li><a  target="_blank" href="https://www.instagram.com/nersiandates/"><i class="lni-instagram-filled"></i></a></li>
                                <li><a  target="_blank" href="https://mobile.twitter.com/nersiandates"><i class="lni-twitter-original"></i></a></li>
                            </ul>
                        </div>
                    </div> <!-- single team -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== TEAM PART ENDS ======-->

    <!--====== TESTIMONIAL PART START ======-->

    <section id="testimonial" class="testimonial-area pt-130 pb-130  gray-bg">
        <div class="container">
            <div class="testimonial-bg bg_cover pt-80 pb-80" style="background-image: url(design/LandingPage/images/testimonial/testimonial-bg.png)">
                <div class="row">
                    <div class="col-xl-4 offset-xl-7 col-lg-5 offset-lg-6 col-md-8 offset-md-2 col-sm-10 offset-sm-1">
                        <div class="testimonial-active">
                            <div class="single-testimonial text-center">
                                <div class="testimonial-image">
                                    <img src="{{url('/')}}/design/LandingPage/images/testimonial/t-1.png" alt="Testimonial">
                                    <div class="quota">
                                        <i class="lni-quotation"></i>
                                    </div>
                                </div>
                                <div class="testimonial-content mt-20">
                                    <p>والله انتم كويسين .. فديتكم</p>
                                    <h5 class="testimonial-name mt-15">وائل ياسين</h5>
                                    <span class="sub-title">مطور سوّق</span>
                                </div>
                            </div> <!-- single-testimonial -->
                            <div class="single-testimonial text-center">
                                <div class="testimonial-image">
                                    <img src="{{url('/')}}/design/LandingPage/images/testimonial/t-2.jpg" alt="Testimonial">
                                    <div class="quota">
                                        <i class="lni-quotation"></i>
                                    </div>
                                </div>
                                <div class="testimonial-content mt-20">
                                    <p>Lorem ipsum dolor sit amet, ectetur adipiscing elit. Phasellus vel erat ces, commodo lectus eu, finibus diam. m ipsum dolor sit amet, ectetur.</p>
                                    <h5 class="testimonial-name mt-15">Alina</h5>
                                    <span class="sub-title">Tesla Motors</span>
                                </div>
                            </div> <!-- single-testimonial -->
                            <div class="single-testimonial text-center">
                                <div class="testimonial-image">
                                    <img src="{{url('/')}}/design/LandingPage/images/testimonial/t-3.jpg" alt="Testimonial">
                                    <div class="quota">
                                        <i class="lni-quotation"></i>
                                    </div>
                                </div>
                                <div class="testimonial-content mt-20">
                                    <p>Lorem ipsum dolor sit amet, ectetur adipiscing elit. Phasellus vel erat ces, commodo lectus eu, finibus diam. m ipsum dolor sit amet, ectetur.</p>
                                    <h5 class="testimonial-name mt-15">Celina</h5>
                                    <span class="sub-title">CEO, Alo</span>
                                </div>
                            </div> <!-- single-testimonial -->
                        </div> <!--  testimonial active -->
                    </div>
                </div> <!-- row -->
            </div> <!-- testimonial bg -->
        </div> <!-- container -->
    </section>

    <!--====== TESTIMONIAL PART ENDS ======-->

    <!--====== CONTACT PART START ======-->

    <section id="contact" class="contact-area pt-125 pb-130">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-title text-center pb-20">
                        <h5 class="sub-title mb-15">سمعنا ملاحظاتك</h5>
                        <h2 class="title">تواصل معنا</h2>
                    </div> <!-- section title -->
                </div>
            </div> <!-- row -->
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="contact-form">
                        <form id="contact-form" action="assets/contact.php" method="post" data-toggle="validator">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="single-form form-group">
                                        <input type="text" name="name" placeholder="اسمك" data-error="Name is required." required="required">
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- single form -->
                                </div>
                                <div class="col-md-6">
                                    <div class="single-form form-group">
                                        <input type="email" name="email" placeholder="ايميلك" data-error="Valid email is required." required="required">
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- single form -->
                                </div>
                                <div class="col-md-6">
                                    <div class="single-form form-group">
                                        <input type="text" name="subject" placeholder="العنوان" data-error="Subject is required." required="required">
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- single form -->
                                </div>
                                <div class="col-md-6">
                                    <div class="single-form form-group">
                                        <input type="text" name="phone" placeholder="جوالك" data-error="Phone is required." required="required">
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- single form -->
                                </div>
                                <div class="col-md-12">
                                    <div class="single-form form-group">
                                        <textarea placeholder="رسالتك" name="message" data-error="Please,leave us a message." required="required"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- single form -->
                                </div>
                                <p class="form-message"></p>
                                <div class="col-md-12">
                                    <div class="single-form form-group text-center">
                                        <button type="submit" class="main-btn">ارسال</button>
                                    </div> <!-- single form -->
                                </div>
                            </div> <!-- row -->
                        </form>
                    </div> <!-- row -->
                </div>
            </div> <!-- row -->
        </div> <!-- container -->
    </section>

    <!--====== CONTACT PART ENDS ======-->

@endsection
