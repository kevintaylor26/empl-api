
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/owl.carousel.min.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Style -->
    <link rel="stylesheet" href="css/auth-signin-style.css">

    <title>Login </title>
  </head>
  <body>


  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background: #1e3b41"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <h3> Login to <strong style="font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;color: #f05c42">Data Company</strong></h3>

            <form method="POST" action="{{ route('api.auth.login') }}">
                @csrf

              <div class="form-group first">
                <label for="email" class="col-md-6 col-form-label">{{ __('E-Mail Address') }}</label>

                <input id="email" type="email" class="form-control  @error('email') is-invalid @enderror" placeholder="Enter E-mail" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

              </div>
              <div class="form-group last mb-3">
                <label for="password" class="col-md-4 col-form-label">{{ __('Password') }}</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter Password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror   </div>

              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                  <input type="checkbox" checked="checked" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}/>
                  <div class="control__indicator"></div>
                </label>
                <span class="ml-auto">
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="forgot-pass">Forgot Password</a></span>
                    @endif
              </div>

              <input type="submit" value="Log In" class="btn btn-block btn-primary">

            </form>
<br><br>
            <h6 style="text-align: center"> <span style="color: grey"> You don't have an account?</span><a href="{{ route('auth.signupPage') }}"> <span style="color: blue"><b>SIGN UP</b></span> </a></h6>
          </div>
        </div>
      </div>
    </div>


  </div>



    <script src="/js/jquery-min.js"></script>
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/main.js"></script>
  </body>
</html>

