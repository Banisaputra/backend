@extends('layouts.admin')

@section('title', 'Chart '.request()->input('title'))
@section('title_with_action')
<span class="text-3xl font-bold text-teal-700">Chart {{ request()->input('title') }}</span>
@endsection

@section('content')
<div class="container mx-auto">
  <div class="flex">
    <x-button as="link" href="{{route('skpg.index')}}" label="Kembali">
      <x-slot name="leftIcon">
        <x-heroicon-s-arrow-left class="w-4 h-4 mr-2.5" />
      </x-slot>
    </x-button>
  </div>

  <div class="my-10">
    <div class="mb-10 text-center">
      <div class="text-3xl mb-1.5 font-medium text-gray-700">Komoditas: <span class="text-green-500">{{ $type->key }}</span></div>
      <div class="text-lg text-gray-500">Data {{ $type->date }}</div>
    </div>

    @include('dashboard.skpg.show.diagram')
    @include('dashboard.skpg.show.map')

  </div>
</div>
@endsection
