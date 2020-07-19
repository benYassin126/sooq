@extends('layouts.app')
@section('content')
<!-- Hero Area Start -->
<div id="hero-area" class="hero-area-bg">
    <div class="container">
        <div class="row showTemplate">
            <div class="col-md-12 col-sm-12 text-center welcomeText">
                @if ($errors->any())
                <div class="alert-dismissible  alert alert-danger" id="display-success">
                    <ul>
                        <h3>للأسف الايميل مسجل من قبل ..</h3>
                    </ul>
                </div>
                @endif
            </div>

                <form id="registerForm" class="form-horizontal" action="{{ url('/try/form3') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <label class="control-label ml-2">اسمك الكريم</label><br>
                    <div class="input-group mb-3">
                        <input  id="name" type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}"  value="{{ old('name') }}" required autofocus>
                        <div class="input-group-append">
                            <span class="input-group-text"></span>
                        </div>
                        @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                        @endif
                    </div>
                    <label class="control-label ml-2">ايميلك</label><br>
                    <div class="input-group mb-3">
                        <input  id="email" type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('E-Mail Address') }}"  value="{{ old('email') }}" required>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                        </div>
                        @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                        @endif
                    </div>
                    <label class="control-label ml-2">الرقم السري</label><br>
                    <div class="input-group mb-3">
                        <input  id="password" type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" required autofocus>
                        <div class="input-group-append">
                            <span class="fa fa-lock input-group-text"></span>
                        </div>
                        @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                        @endif
                    </div>
                    <div class="div-center">
                        <button  class="btn btn-success">حفظ وارسال </button>
                    </div>
                </form>
        </div>
    </div>
</div>
@endsection
