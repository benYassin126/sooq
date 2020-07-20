@extends('layouts.app')

@section('content')
<div class="login-box">
  <div>
    <h5 class="text-center ">{{ __('Login') }}</h5>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">

      <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="input-group mb-3">
          <input  id="email" type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('E-Mail Address') }}"  value="{{ old('email') }}" required autofocus>

          <div class="input-group-append">
            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
          </div>

          @if ($errors->has('email'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
          </span>
          @endif
        </div>

        <div class="input-group mb-3">
          <input  id="password" type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}"  value="" required autofocus>
          <div class="input-group-append">
            <span class=" input-group-text"><i class="fa fa-lock"></i></span>
          </div>

          @if ($errors->has('password'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('password') }}</strong>
          </span>
          @endif
        </div>
        <div class="row">
          <div class="col-8">
            <div class="checkbox icheck">
              <label>
               <input class="form-check-input" type="checkbox" name="remember" id="remember" > {{ __('Remember Me') }}
             </label>
           </div>
         </div>
         <!-- /.col -->
         <div class="div-center">
          <button type="submit" class="btn btn-primary">{{ __('Login') }}</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

    <p class="mb-0">
      <a href="{{ route('register') }}">ماعندي حساب</a>
    </p>
  </div>
  <!-- /.login-card-body -->
</div>
</div>
@endsection
