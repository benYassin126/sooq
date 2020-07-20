@extends('layouts.app')

@section('content')
    <!-- Hero Area Start -->
    <div id="hero-area" class="hero-area-bg">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12">
            <div class="contents text-center">
              <h2 class="head-title wow fadeInUp">حياك في  <span style="color: #3d60f4">{{ config('app.name') }}</span> <br> منصة تساعدك في تصميم محتوى رهيب لمنصات التواصل الإجتماعي</h2>
              <div class="header-button wow fadeInUp" data-wow-delay="0.3s">
                <a href="{{ route('try') }}" class="btn btn-common">جرب الآن</a>
              </div>
            </div>
            <div class="img-thumb text-center wow fadeInUp" data-wow-delay="0.6s">
              <img class="img-fluid" src="{{url('/')}}/design/LandingPage/img/hero-1.png" alt="">
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Hero Area End -->
@endsection
