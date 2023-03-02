@extends('layouts.admin')

@section('title', $commodity->name)

@section('title_with_action')
<span class="text-3xl font-bold text-teal-700">{{ $commodity->name }}</span>
@endsection

@section('content')
<div class="bg-gray-50 p-10 rounded-lg">
  <div class="flex items-center">
    <x-button as="link" href="{{route('commodities.index')}}" class="mr-3.5" label="Kembali" theme="outline">
      <x-slot name="leftIcon">
        <x-heroicon-s-arrow-left class="w-4 h-4 mr-2.5" />
      </x-slot>
    </x-button>
    <x-button as="link" href="{{route('commodities.edit', ['commodity' => $commodity->id])}}" label="Edit Komoditas">
      <x-slot name="leftIcon">
        <x-heroicon-s-pencil class="w-4 h-4 mr-2.5" />
      </x-slot>
    </x-button>
  </div>

  <div class="flex mt-10 mb-16">
    <img class="w-64 rounded-lg mr-12" src="{{ $commodity->image }}" alt="">
    <div class="space-y-8">
      <div>
        <div class="text-sm font-medium text-green-500 mb-2">Nama Komoditas</div>
        <div class="text-lg">{{ $commodity->name }}</div>
      </div>
      <div>
        <div class="text-sm font-medium text-green-500 mb-2">Unit</div>
        <div class="text-lg">{{ $commodity->unit ?: '-' }}</div>
      </div>
      <div>
        <div class="text-sm font-medium text-green-500 mb-2">
          Harga Terbaru
          <span class="italic text-gray-500 font-normal">(per {{ \Carbon\Carbon::parse($commodity->lastPrice->created_at)->translatedFormat(get_cache('date_time_format')) }})</span>
        </div>
        <div class="text=lg">{{ format_currency($commodity->lastPrice->price) }}</div>
      </div>
    </div>
  </div>

  <div>
    {!! $chart->container() !!}
  </div>
</div>
@endsection

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
{!! $chart->script() !!}
@endpush
