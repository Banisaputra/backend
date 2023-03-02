<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <meta name="msapplication-TileImage" content="{{ get_cache('favicon')}}" />
    <link rel="icon" href="{{ get_cache('favicon')}}" sizes="32x32" />
    <link rel="apple-touch-icon" href="{{ get_cache('favicon')}}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/alpine.js') }}" defer></script>
    @stack('head')
  </head>
  <body class="bg-[#fcfdff] min-h-screen">
    @yield('content')
  </body>
</html>