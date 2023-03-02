@extends('layouts.default')

@section('content')
<div class="container mx-auto px-4 pt-16 pb-24 2xl:pt-24 2xl:pb-32">
  <div class="flex lg:flex-row flex-col">
    <div class="lg:flex-grow xl:w-1/2 flex flex-col xl:items-start xl:text-left mb-3 md:mb-12 lg:mb-0 items-center justify-center text-center">
      <p class="mb-3 leading-relaxed font-semibold text-sm text-green-500">
        {{ get_cache('subheading') }}
      </p>
      <h1 class="text-4xl sm:text-5xl 2xl:text-6xl mb-8 font-semibold max-w-xl sm:leading-tight 2xl:leading-snug">
        {{ get_cache('site_name_short', config('app.name')) }}
      </h1>
      <img class="max-h-[350px] mb-5 hidden lg:block xl:hidden" src="{{ get_cache('hero_short') }}" alt="" />
      @if (get_cache('address'))
        <div class="hidden xl:block rounded-lg p-5 border border-gray-100">
          <x-heroicon-o-location-marker class="text-gray-400 w-6 h-6 mb-4 mx-auto xl:mx-0" />
          <p class="max-w-lg text-gray-400 leading-relaxed text-sm">
            {!! nl2br(get_cache('address')) !!}
          </p>
        </div>
      @endif
    </div>
    @if (get_cache('hero_shot'))
      <div class="w-full xl:w-1/2 text-center justify-center flex pr-0 xl:pl-20">
        <div class="w-1/5 h-1"></div>
        <div class="relative w-4/5 mt-12">
          <img class="relative h-full max-h-[450px] rounded-3xl z-10 object-center object-cover" src="{{ get_cache('hero_shot') }}" alt="" />
          <div class="bg-green-50 rounded-3xl ml-auto absolute -top-12 -left-12 right-12 bottom-12"></div>
        </div>
      </div>
    @endif
  </div>
</div>

@if (get_cache('show_kwt_search'))
<div class="bg-gray-50">
  <div class="container px-4 py-24 mx-auto">
    <div class="text-center">
      <x-heroicon-s-search-circle class="w-10 h-10 text-gray-300 mb-4 mx-auto" />
      <div class="text-3xl font-semibold text-gray-700">
        <span>Validasi Bantuan</span>
        <span class="text-green-500">KWT</span>
      </div>
    </div>
    <form action="{{route('search-kwt')}}" class="max-w-3xl w-full flex items-center mx-auto mt-10">
      <x-text-input class="!py-3.5" type="text" name="q" autocomplete="off" placeholder="Cari berdasarkan nama kelompok, nama ketua atau nomor registrasi" />
      <x-button class="ml-5" label="Cari" />
    </form>
  </div>
</div>
@endif

@php
  $programKerja = [
    'Evaluasi dan Monitoring Lembaga Pangan',
    'Pengembangan Cadangan Pangan Masyarakat.',
    'Penguatan Ketahanan Pangan Tingkat Desa',
  ]
@endphp

<div class="bg-gray-900">
  <div class="container px-4 py-24 mx-auto">
    <div class="flex flex-col text-center w-full">
      <h2 class="text-2xl lg:text-3xl xl:text-4xl font-semibold mb-2.5 !leading-normal text-white">
        Program Kerja
      </h2>
      <h3 class="text-sm md:text-base font-light mx-12 lg:w-full md:w-full sm:w-3/6 sm:mx-auto text-gray-300">
        {{ get_cache('site_name', config('app.name')) }}
      </h3>
    </div>
    <div class="mt-4 h-1 bg-white w-16 mx-auto"></div>
    <div class="flex lg:flex-row flex-col -m-4 mt-20 lg:text-lg">
      @foreach ($programKerja as $index => $item)
        <div class="bg-gray-800/25 rounded-3xl mx-3 px-14 md:px-0 lg:px-4 lg:w-1/3 md:w-2/3 sm:w-4/6 group hover:bg-gray-800 transition duration-500">
          <div class="flex h-full lg:pt-8 lg:pb-8 md:pt-8 md:pb-8 pt-4 flex-col">
            <div class="items-center text-center text-green-500 italic mb-2">
              <div class="inline-flex items-center justify-center rounded-full mb-6 text-white bg-gradient-to-tr from-green-500 to-green-400/50 w-16 h-16">
                # {{ $index + 1 }}
              </div>
            </div>
            <div class="flex-grow">
              <h4 class="font-medium text-center mb-2.5 text-gray-400 group-hover:text-white transition duration-200 lg:max-w-sm mx-auto">
                {{ $item }}
              </h4>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>

@php
  $sortedCommodities = $commodities->sortByDesc('lastPrice.created_at');
@endphp
<div>
  <div class="container px-4 pt-16 pb-24 mx-auto">
    <div class="flex flex-col text-center w-full mb-20">
      <h2 class="text-2xl lg:text-3xl xl:text-4xl font-semibold mb-2.5 !leading-normal text-gray-600">
        Harga Pangan
      </h2>
      <div class="text-base font-light mx-12 lg:w-full md:w-full sm:w-3/6 sm:mx-auto">
        <span class="mr-1.5">Terakhir diperbarui:</span>
        @if (!$commodities->isEmpty())
          <span class="block mt-1.5 md:inline-block md:mt-0 font-medium border border-green-500 rounded-md py-1.5 px-2.5 text-sm text-green-500">
            {{ \Carbon\Carbon::parse($sortedCommodities->first()->lastPrice->created_at)->translatedFormat('l, d F Y H:i \W\I\B') }}
          </span>
        @else
          -
        @endif
      </div>
    </div>
    <div class="flex lg:flex-row flex-col">
      <div class="grid sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-6 w-full">
        @foreach ($commodities as $commodity)
          <div class="relative border border-green-500/20 bg-[#f5fffc] flex lg:flex-row flex-col p-2.5 rounded-xl">
            <div class="h-20 lg:w-20 flex-none bg-cover text-center overflow-hidden rounded-lg bg-center" style="background-image: url('{{$commodity['image']}}')" title="{{$commodity['name']}}"></div>
            <div class="rounded px-2.5 flex flex-col leading-normal ml-2.5 mt-3 lg:mt-2 xl:mt-0">
              <div class="text-black font-medium flex items-center text-lg lg:mr-3.5 md:mr-3.5 mr-0">
                {{$commodity['name']}}
              </div>
              <div class="text-gray-500 mt-1 text-sm flex items-center">
                {{format_currency($commodity['lastPrice']['price'])}},-
                
                @if ($commodity['unit'])
                  <span class="italic ml-2 bg-green-500 text-white text-xs px-2 py-1 rounded">
                    per {{$commodity['unit']}}
                  </span>
                @endif
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>

<div class="bg-gray-50">
  <div class="container px-4 py-24 mx-auto">
    <div class="flex flex-col text-center w-full mb-12">
      <h2 class="text-2xl lg:text-3xl xl:text-4xl font-semibold mb-2.5 !leading-normal text-gray-600">
        Informasi Publik
      </h2>
      <h3 class="text-sm md:text-base font-light mx-12 lg:w-full md:w-full sm:w-3/6 sm:mx-auto text-medium-white">
        Informasi, Berita & Press Release
      </h3>
      <div class="mt-4 h-1 bg-green-500 w-16 mx-auto"></div>
    </div>
    <div class="md:grid md:grid-cols-2 lg:grid-cols-3 gap-6 space-y-4 md:space-y-0">
      @foreach ($latestPosts as $post)
        <x-post.card :post="$post" />
      @endforeach
    </div>

    <div class="flex justify-center mt-16">
      <a href="{{route('blog', ['page' => 2])}}" class="flex items-center py-4 px-6 ml-2 border border-teal-500 bg-green-500 text-white rounded-full font-bold hover:bg-white hover:text-green-500 transition">
        <span>
          Berita Lainnya
        </span>
        <x-heroicon-s-arrow-narrow-right class="w-5 h-5 ml-2" />
      </a>
    </div>
  </div>
</div>
@endsection
