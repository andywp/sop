<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ URL::asset("assets/admin-lte/plugins/fontawesome-free/css/all.min.css") }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link rel="stylesheet" href="{{ URL::asset("assets/admin-lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css") }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ URL::asset("assets/admin-lte/dist/css/adminlte.min.css") }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">

<div class="login-box">
    <div class="login-logo">
      <a href="{{ URL::asset('') }}"><b>SOP </b>QWORDS</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>

        <div class="social-auth-links text-center mb-3">
          <button id="login-sso" class="btn btn-block btn-danger">
          <i class="fas fa-sign-in-alt"></i> Login with SSO
          </button>
          <form action="https://sso.qwords.com/sso/api/v1/login?service=google" id="sso-login" method="post" name="sso-login">
                <input name="QW-PUBLIC" type="hidden" value="oF+gIiG3LHFjdW*9Q#UWgBOzVacqq0Sjc(sRhNldkdSJf@2XUT~Z9HUR#p3Z"> 
                <input name="QW-SECRET" type="hidden" value="cu1OwZy#&Jp9Vhv8qnVH)gWWYV($F6LIl$c5qt!ORCVnez^PWTl!@jDX@d(Z">
		    	</form>
        </div>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->


    <script src="{{ URL::asset('assets/admin-lte/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::asset('assets/dist/js/adminlte.min.js') }}"></script>
    <script>
	      $(function(){
	          $('#login-sso').click(function(){
	              $('#sso-login').submit();
	          });
	      })
	</script>
</body>
</html>
