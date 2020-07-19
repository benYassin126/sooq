@extends('layouts.app')

@section('content')
<div class="login-box">
  <div>
    <h5 class="text-center ">{{ __('Register') }}</h5>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">

      <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="input-group mb-3">
          <input  id="name" type="text" name="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="{{ __('Name') }}"  value="{{ old('name') }}" required autofocus>

          <div class="input-group-append">
            <span class="input-group-text"> <i class="fa fa-user"></i></span>
          </div>

          @if ($errors->has('name'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('name') }}</strong>
          </span>
          @endif
        </div>

        <div class="input-group mb-3">
          <input  id="email" type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('E-Mail Address') }}"  value="{{ old('email') }}" required>

          <div class="input-group-append">
            <span class="input-group-text"> <i class="fa fa-envelope"></i></span>
          </div>

          @if ($errors->has('email'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
          </span>
          @endif
        </div>

        <div class="input-group mb-3">
          <input  id="password" type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" required autofocus>
          <div class="input-group-append">
            <span class=" input-group-text"><i class="fa fa-lock"></i></span>
          </div>

          @if ($errors->has('password'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('password') }}</strong>
          </span>
          @endif
        </div>


        <div class="input-group mb-3">
          <input  id="password" type="password" name="password_confirmation" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Confirm Password') }}"   required autofocus>
          <div class="input-group-append">
            <span class=" input-group-text"> <i class="fa fa-lock"></i></span>
          </div>
        </div>

        <div class="row">
         <!-- /.col -->
         <div class="div-center">
          <button type="submit" class="btn btn-primary">  {{ __('Register') }}</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-card-body -->
</div>
</div>
@endsection
