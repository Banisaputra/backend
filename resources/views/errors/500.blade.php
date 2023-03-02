@extends('layouts.blank')

@section('title', '403 Forbidden')

@section('content')
<div class="flex justify-center items-center min-h-screen py-10" x-data="{}">
  <div class="container mx-auto flex items-center justify-center flex-col">
    <div class="text-5xl mb-10 font-medium text-gray-600">Error 500</div>
    <div class="text-center w-full">
      <h1 class="text-2xl mb-5 font-semibold text-gray-600">
        Internal server error
      </h1>
      <p class="mb-10 tracking-wide leading-7 text-gray-400 max-w-sm mx-auto">
        Server sedang mengalami masalah, silahkan coba beberapa saat lagi atau hubungi sistem administrator.
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