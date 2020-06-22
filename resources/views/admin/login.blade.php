
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet"  href="{{url('/')}}/design/AdminLTE/dist/css/adminlte.css">
  <!-- iCheck -->
  <link rel="stylesheet"  href="{{url('/')}}/design/AdminLTE/plugins/iCheck/square/blue.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- bootstrap rtl -->
  <link rel="stylesheet"  href="{{url('/')}}/design/AdminLTE/dist/css/bootstrap-rtl.min.css">
  <!-- template rtl version -->
  <link rel="stylesheet"  href="{{url('/')}}/design/AdminLTE/dist/css/custom-style.css">
</head>
<body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">


@if(session()->has('erorrMsg'))
<div class="alert alert-danger" role="alert" id="display-success">
   <strong>{{session()->get('erorrMsg') }}</strong>
   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
</button>
@endif

    </div>
    <!-- /.login-logo -->
    <h2 class="mb-3">{{ config('app.name') }}</h2>
    <div class="card">
        <div class="card-body login-card-body">



          <form method="POST">
             @csrf
             <div class="input-group mb-3">
              <input  id="email" type="email" name="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="ايميلك"  value="{{ old('email') }}" required autofocus>
              <div class="input-group-append">
                <span class="fa fa-envelope input-group-text"></span>
            </div>
            @if ($errors->has('email'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
            @endif
        </div>

        <div class="input-group mb-3">
            <input  id="password" type="password" name="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="الرقم السري"  value="{{ old('password') }}" required autofocus>
      <div class="input-group-append">
        <span class="fa fa-lock input-group-text"></span>
    </div>
        @if ($errors->has('password'))
         <span class="fa fa-lock input-group-text"></span>
            <strong>{{ $errors->first('password') }}</strong>
        </span>
        @endif
    </div>
<div class="row">
  <div class="col-8">
    <div class="checkbox icheck">
      <label>
         <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> تذكرني
    </label>
</div>
</div>
<!-- /.col -->
<div class="col-4">
    <button type="submit" class="btn btn-primary btn-block btn-flat">دخول</button>
</div>
<!-- /.col -->
</div>
</form>

</div>
<!-- /.login-card-body -->
</div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script  src="{{url('/')}}/design/AdminLTE/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script  src="{{url('/')}}/design/AdminLTEplugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- iCheck -->
<script  src="{{url('/')}}/design/AdminLTE/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass   : 'iradio_square-blue',
      increaseArea : '20%' // optional
  })
})
</script>
</body>
</html>
