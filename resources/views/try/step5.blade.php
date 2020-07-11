@extends('layouts.app')

@section('content')
<!-- Hero Area Start -->
<div id="hero-area" class="hero-area-bg">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12">

        <div class="MultiForm text-center">

            <!-- progressbar -->
            <ul id="progressbar">
                <li class="active"  id="imges"><strong>الصور</strong></li>
                <li  id="colors"><strong>هويتك</strong></li>
                <li  id="show"><strong>شرايك ؟</strong></li>
                <li class="active" id="account"><strong>كمل بيناتك</strong></li>
                <li class="active" id="confirm"><strong>استلم محتواك</strong></li>
            </ul>
            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"></div>
            </div> <br>


            <h2 class="head-title wow fadeInUp">خطوتين فقط اصنع محتواك التسويقي !</h2>
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
