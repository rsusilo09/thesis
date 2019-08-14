<!DOCTYPE html>
<html>
  @extends('script')
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>Login Page</b>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Login to start reserve your restaurant</p>

    {!! Form::open(array('route' => 'login', 'method' => 'POST')) !!}
      <div class="form-group has-feedback">
        {{-- <input type="email" class="form-control" placeholder="Username"> --}}
        {!! Form::text('username', null, ['class' => 'form-control', 'placeholder' => 'Username']) !!}
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Password']) !!}
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
        </div>
        <!-- /.col -->
      </div>
      {!! Form::close() !!}

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

</body>
</html>
