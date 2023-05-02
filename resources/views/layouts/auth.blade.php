<!DOCTYPE html>
<html lang="en">

<head>
  <title>{{ $title }} - INSPACE</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--===============================================================================================-->
  <!-- <link rel="icon" type="image/png" href="images/icons/favicon.ico"/> -->
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{ asset('auth/vendor/bootstrap/css/bootstrap.min.css') }}">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{ asset('auth/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{ asset('auth/vendor/animate/animate.css') }}">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{ asset('auth/vendor/css-hamburgers/hamburgers.min.css') }}">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{ asset('auth/vendor/animsition/css/animsition.min.css') }}">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{ asset('auth/vendor/select2/select2.min.css') }}">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{ asset('auth/vendor/daterangepicker/daterangepicker.css') }}">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="{{ asset('auth/css/util.css') }}">
  <link rel="stylesheet" type="text/css" href="{{ asset('auth/css/main.css') }}">
  <!--===============================================================================================-->

  @stack('styles')
</head>

<body style="background-color: #666666;">

  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        @yield('content')

        <div class="login100-more" style="background-image: url('auth/images/bg.png');">
        </div>
      </div>
    </div>
  </div>





  <!--===============================================================================================-->
  <script src="{{ asset('/auth/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
  <!--===============================================================================================-->
  <script src="{{ asset('/auth/vendor/animsition/js/animsition.min.js') }}"></script>
  <!--===============================================================================================-->
  <script src="{{ asset('/auth/vendor/bootstrap/js/popper.js') }}"></script>
  <script src="{{ asset('/auth/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
  <!--===============================================================================================-->
  <script src="{{ asset('/auth/vendor/select2/select2.min.js') }}"></script>
  <!--===============================================================================================-->
  <script src="{{ asset('/auth/vendor/daterangepicker/moment.min.js') }}"></script>
  <script src="{{ asset('/auth/vendor/daterangepicker/daterangepicker.js') }}"></script>
  <!--===============================================================================================-->
  <script src="{{ asset('/auth/vendor/countdowntime/countdowntime.js') }}"></script>
  <!--===============================================================================================-->
  <script src="{{ asset('/auth/js/main.js') }}"></script>

  @stack('scripts')
</body>

</html>