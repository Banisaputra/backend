@extends('layouts.blank')

@section('title', 'Halaman Tidak Ditemukan')

@section('content')
<div class="flex justify-center items-center min-h-screen py-10" x-data="{}">
  <div class="container mx-auto flex items-center justify-center flex-col">
    <img class="sm:w-auto w-5/6 sm:mb-16 mb-12 object-cover object-center max-w-[200px]" src="{{ asset('icons/Empty-404.png') }}" alt="">          
    <div class="text-center w-full">
      <h1 class="text-2xl mb-5 font-semibold text-gray-600">
        Maaf, halaman ini tidak tersedia
      </h1>
      <p class="mb-10 tracking-wide leading-7 text-gray-400 max-w-sm mx-auto">
        Tautan yang anda ikuti mungkin telah kadaluarsa, atau halaman telah dihapus.
      </p>
      <div class="flex justify-center">
        <x-button as="link" href="{{route('home')}}" class="!rounded-full" theme="outline" label="Kembali ke Halaman Awal" />
      </div>
    </div>
  </div>
</div>
@endsection

@push('head')
<meta name="robots" content="noindex, nofollow" />
@endpush