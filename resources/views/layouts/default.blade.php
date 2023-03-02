<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', get_cache('site_name'))</title>
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
    <meta name="description" content="@yield('meta_description', 'Dinas Ketahanan Pangan bertugas dalam bidang ketersediaan pangan, distribusi pangan, cadangan pangan, konsumsi dan keamanan pangan.')"/>
  </head>
  <body>
    @auth
      <div class="bg-black text-white p-4 text-sm flex flex-col md:flex-row items-center justify-between">
        <div>
          You are signed in as
          <span class="text-gray-400 underline">
            {{Auth()->user()->username}} ({{Auth()->user()->display_name}})
          </span>
        </div>
        <div class="space-x-4 flex items-center">
          <a href="{{ route('dashboard') }}" class="bg-green-500 py-2 px-4 text-sm text-white rounded hover:text-gray-700">
            Go to dashboard
          </a>
          <a href="{{ route('logout') }}" class="text-red-400 flex items-center px-4">
            <x-heroicon-o-logout class="w-5 h-5 mr-2" />
            <span>Log out</span>
          </a>
        </div>
      </div>
    @endauth

    <div class="border-t-4 border-green-500">
      <header class="container mx-auto px-4 py-6 lg:py-10" x-data="{ open: false }">
        <div class="mx-auto flex items-center justify-between lg:justify-start">
          @if (get_cache('show_site_name_on_logo'))
            <a class="flex items-center" href="/">
              <img class="w-12" src="{{ get_cache('logo')}}" alt="" />
              <span class="ml-5 text-sm font-semibold text-gray-600 leading-relaxed max-w-[250px]">
                {{ get_cache('site_name') }}
              </span>
            </a>
          @else
            <a class="mr-8 flex items-center" href="/">
              <img class="h-16 md:h-20" src="{{ get_cache('logo')}}" alt="" />
            </a>
          @endif
          <div class="flex mr-0 lg:hidden cursor-pointer">
            <x-heroicon-o-menu @click="open = !open" class="w-8 h-8 text-green-500" />
          </div>
          <div :class="{'hidden': !open}" class="bg-green-500/95 fixed w-full hidden h-full top-0 left-0 z-30" @click="open = !open"></div>
          <nav class="navigation lg:mr-auto hidden flex-col text-base justify-center z-50 fixed top-8 left-3 right-3 p-8 rounded-md shadow-md bg-white lg:flex lg:flex-row lg:relative lg:top-0 lg:shadow-none bg-popup lg:bg-transparent lg:p-0 lg:items-center items-start" :class="{'flex': open, 'hidden': !open}">
            @foreach ($menus as $menu)
              <x-nav-menu :menu="$menu" />
            @endforeach

            <x-heroicon-s-x @click="open = !open" class="w-8 h-8 absolute top-5 right-5 lg:hidden cursor-pointer text-red-500" />
          </nav>
        </div>
      </header>
    
      @yield('content')
      
      <footer class="bg-black">
        <div class="container mx-auto py-12 px-6">
          <div class="xl:flex items-center justify-between">
            <div class="flex flex-col items-center sm:flex-row sm:justify-center">
              <img class="h-28 mb-6 sm:mr-7 sm:mb-0 lg:h-32 lg:mr-10" src="{{ get_cache('logo', '/logoipsum-logo-64-light.svg')}}" alt="">
              <div class="text-center sm:text-left">
                <h2 class="text-2xl font-semibold mb-3 text-green-500">
                  {{ get_cache('site_name_short') }}
                </h2>
                <p class="text-sm text-gray-300 leading-relaxed md:w-96">
                  {{ get_cache('address') }}
                </p>
              </div>
            </div>
            <iframe title="Peta Dinas Ketahanan Pangan Kabupaten Boyolali" class="mt-8 h-40 w-full xl:mt-0 2xl:h-48 xl:max-w-md" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15820.9493815777!2d110.6083025!3d-7.5490772!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xfa38342972b9d505!2sKetahanan%20Pangan%20Kab%20Boyolali!5e0!3m2!1sen!2sid!4v1650378115698!5m2!1sen!2sid" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
          <hr class="mt-10 border-b border-gray-800">
          <div class="border-color mx-auto text-center text-gray-400 lg:text-left">
            <div class="lg:flex lg:items-center lg:justify-between pt-10">
              <div class="flex pb-3 lg:pb-0 flex-col lg:flex-row items-center">
                <div class="flex font-medium items-center mb-2 md:mb-0 space-x-3">
                  @php
                    $phone = get_cache('phone_number');
                    $socials = collect(config('settings'))->flatten(1)->filter(function($setting) {
                        return \Str::startsWith($setting['attributes']['name'], 'social');
                    });
                  @endphp
                  @foreach ($socials as $social)
                    @php
                      $value = get_cache($social['attributes']['name']);
                      $social_media_name = explode('social_', $social['attributes']['name'])[1];
                    @endphp
                    @if ($value)
                      <a aria-label="Klik untuk mengunjungi {{$social_media_name}} DKP Boyolali" target="_blank" href="{{$value}}" class="bg-white rounded-lg p-2 grayscale hover:grayscale-0">
                        <img class="w-4" src="{{$social['icon']}}" alt="">
                      </a>
                    @endif
                  @endforeach
                </div>
                @if ($phone)
                  <div class="lg:!ml-8 mt-4 lg:mt-0 text-sm">Telp: {{ $phone }}</div>
                @endif
              </div>

              <div class="text-sm">Copyright © {{date('Y')}} {{ get_cache('site_name') }}</div>
            </div>
          </div>
        </div>
      </footer>
    </div>

    <x-notify />

    @stack('script')
  </body>
</html>
