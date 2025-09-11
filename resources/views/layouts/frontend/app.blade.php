{{-- resources/views/layouts/frontend/app.blade.php --}}
<!doctype html>
<html lang="{{ str_replace('_','-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>@yield('title', 'Seafarer Jobs')</title>

  {{-- Bootstrap CSS (CDN) --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">

  {{-- FontAwesome --}}
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" crossorigin="anonymous">

  {{-- Your separated stylesheet --}}
  <link href="{{ asset('frontend/assets/css/style.css') }}" rel="stylesheet">

  @stack('head')
</head>
<body>
  <div id="app" class="frontend-app">

    {{-- Include Header --}}
    @includeWhen(View::exists('layouts.frontend.header'), 'layouts.frontend.header')

    <main>
      @yield('content')
    </main>

    {{-- Include Footer --}}
    @includeWhen(View::exists('layouts.frontend.footer'), 'layouts.frontend.footer')
  </div>

  {{-- Bootstrap JS --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

  {{-- Optional JS file if you put one --}}
  {{-- <script src="{{ asset('frontend/assets/js/login.js') }}"></script> --}}

  @stack('scripts')
</body>
</html>
