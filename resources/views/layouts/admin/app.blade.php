<!doctype html>
<html lang="en" class="semi-dark">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="{{ asset('theme/assets/images/favicon-32x32.png') }}" type="image/png">
  <!--plugins-->
  <link href="{{ asset('theme/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet">
  <link href="{{ asset('theme/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet">
  <link href="{{ asset('theme/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
  <link href="{{ asset('theme/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="{{ asset('theme/assets/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('theme/assets/css/bootstrap-extended.css') }}" rel="stylesheet">
  <link href="{{ asset('theme/assets/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('theme/assets/css/icons.css') }}" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <link href="{{ asset('theme/assets/css/pace.min.css') }}" rel="stylesheet">

  <!-- Theme Styles -->
  <link href="{{ asset('theme/assets/css/dark-theme.css') }}" rel="stylesheet">
  <link href="{{ asset('theme/assets/css/light-theme.css') }}" rel="stylesheet">
  <link href="{{ asset('theme/assets/css/semi-dark.css') }}" rel="stylesheet">
  <link href="{{ asset('theme/assets/css/header-colors.css') }}" rel="stylesheet">
  <link href="{{ asset('theme/assets/css/common.css') }}" rel="stylesheet">

  <!-- Page-specific styles -->
  @stack('styles')

  <title>Jano Training::Dashboard</title>
</head>

<body>

  <!--start wrapper-->
  <div class="wrapper">
    <!--start top header-->
    @include('layouts.admin.header')
    @include('layouts.admin.sidebar')
    @yield('content')
    <div class="overlay nav-toggle-icon"></div>
    @include('layouts.admin.footer')
    <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
  </div>
  <!--end wrapper-->

  <script src="{{ asset('theme/assets/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('theme/assets/js/jquery.min.js') }}"></script>
  <script src="{{ asset('theme/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
  <script src="{{ asset('theme/assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
  <script src="{{ asset('theme/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
  <script src="{{ asset('theme/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
  <script src="{{ asset('theme/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
  <script src="{{ asset('theme/assets/js/pace.min.js') }}"></script>
  <script src="{{ asset('theme/assets/plugins/chartjs/js/Chart.min.js') }}"></script>
  <script src="{{ asset('theme/assets/plugins/chartjs/js/Chart.extension.js') }}"></script>
  <script src="{{ asset('theme/assets/js/app.js') }}"></script>
  <script src="{{ asset('theme/assets/js/index4.js') }}"></script>
  <script>
    new PerfectScrollbar(".best-product")
  </script>

  @stack('scripts')
</body>
</html>
