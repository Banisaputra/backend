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
    <style>
      .bg-medium-white {
        background-color: #fcfdff;
      }
    </style>
  </head>
  <body class="bg-gray-100 min-h-screen">
    <div class="lg:grid lg:grid-cols-12 h-full min-h-screen bg-medium-white">
      <div class="relative hidden lg:block h-full lg:col-span-5">
        <img class="absolute object-fill top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 pl-24"
          src="{{ asset('icons/auth-state.png') }}"
          alt="" />
      </div>
      <div
        class="flex items-center h-full px-8 sm:px-16 py-10 lg:mx-0 lg:col-span-7 lg:col-start-7 xl:col-start-7 xl:col-span-5">
        <div class="w-full sm:w-9/12 md:w-8/12 lg:w-10/12 2xl:w-9/12 mx-auto lg:mx-0">
          <div class="items-center justify-center lg:hidden flex">
            <img
              src="{{ asset('icons/auth-state.png') }}"
              alt="" />
          </div>
          @yield('content')
        </div>
      </div>
    </div>
  </body>
</html>