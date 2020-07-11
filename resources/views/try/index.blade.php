@extends('layouts.app')

@section('content')
    <!-- Hero Area Start -->
    <div id="hero-area" class="hero-area-bg">
      <div class="container">
        <div class="row">
          <div class="col-md-12 col-sm-12">
            <div class="contents text-center">
              <h2 class="head-title wow fadeInUp">اصنع محتواك التسويقي  خلال دقائق !!</h2>
              <div class="header-button wow fadeInUp" data-wow-delay="0.3s">
                <a href="{{ url('/try/form1') }} " class="btn btn-common">اصنع محتوى الآن !</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Hero Area End -->
@endsection
