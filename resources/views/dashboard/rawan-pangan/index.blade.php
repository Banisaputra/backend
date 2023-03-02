@extends('layouts.admin')

@section('title', 'Rawan Pangan')

@section('title_with_action')
<span class="text-3xl font-bold text-teal-700">Rawan Pangan</span>
@endsection

@section('content')
<div>
  <div class="text-base font-light mx-12 lg:w-full md:w-full sm:w-3/6 sm:mx-auto mb-7 bg-gray-50 rounded-lg p-4">
    <span>Data terakhir diperbarui: </span>
    @if ($lastUpdated)
      <span class="block mt-1.5 ml-2 md:inline-block md:mt-0 font-medium border border-green-500 rounded-md py-1.5 px-2.5 text-sm text-green-500">
        {{ $lastUpdated }}
      </span>

      <a class="text-green-500 mb-10 font-medium ml-4" href="{{route('peta-rawan-pangan')}}">
        Lihat Peta
      </a>
      @else
      Data belum tersedia
    @endif
  </div>
  
  <form class="max-w-xl" action="{{route('rawan-pangan.store')}}" method="post" enctype="multipart/form-data">
    @csrf
  
    <x-file-input
      name="file"
      accept=".xlsx, .xls"
    />
  
    <x-button class="mt-5" label="Upload Data">
      <x-slot name="leftIcon">
        <x-heroicon-o-cloud-upload class="w-4 h-4 mr-2" />
      </x-slot>
    </x-button>
  </form>
</div>
@endsection
