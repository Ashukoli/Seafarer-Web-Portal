<!doctype html>
<html lang="en" class="semi-dark">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="{{ asset('theme/assets/images/favicon-32x32.png') }}" type="image/png">
  <!-- Plugins & Theme CSS -->
  <link href="{{ asset('theme/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet">
  <link href="{{ asset('theme/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet">
  <link href="{{ asset('theme/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
  <link href="{{ asset('theme/assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet">
  <link href="{{ asset('theme/assets/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('theme/assets/css/bootstrap-extended.css') }}" rel="stylesheet">
  <link href="{{ asset('theme/assets/css/style.css') }}" rel="stylesheet">
  <link href="{{ asset('theme/assets/css/icons.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link href="{{ asset('theme/assets/css/pace.min.css') }}" rel="stylesheet">
  <link href="{{ asset('theme/assets/css/dark-theme.css') }}" rel="stylesheet">
  <link href="{{ asset('theme/assets/css/light-theme.css') }}" rel="stylesheet">
  <link href="{{ asset('theme/assets/css/semi-dark.css') }}" rel="stylesheet">
  <link href="{{ asset('theme/assets/css/header-colors.css') }}" rel="stylesheet">
  <title>Jano Training::Dashboard</title>
  @stack('styles')
</head>
<body>
  <div class="wrapper">
    @include('layouts.company.header')
    @include('layouts.company.sidebar')
    @yield('content')
    <div class="overlay nav-toggle-icon"></div>
    @include('layouts.company.footer')
    <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
  </div>
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
  <script>new PerfectScrollbar(".best-product")</script>
  @stack('scripts')
</body>
</html>
