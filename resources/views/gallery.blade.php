@extends('layouts.default')

@section('title', 'Galeri')

@section('content')
<div class="container px-6 pt-16 pb-24 mx-auto">
  <div class="flex flex-col text-center w-full mb-20">
    <h1 class="text-2xl lg:text-3xl font-semibold mb-2.5 !leading-normal">
      Galeri
    </h1>
  </div>

  <div class="grid lg:grid-cols-3 gap-5 mt-8">
    @foreach ($gallery as $item)
      @php
        $firstImage = collect($item->content)->where('type', 'image')->first();
      @endphp
      <a href="{{ route('post', ['slug' => $item->slug]) }}" class="relative group border border-gray-200 rounded-lg overflow-hidden">
        <div class="block relative h-48">
          @if ($firstImage)
            <img alt="" class="object-cover object-center w-full h-full block" src="{{ $firstImage->data->file->url }}">
          @else
            <div class="flex items-center justify-center text-sm bg-gray-200 text-gray-400 h-full">No image available</div>
          @endif
        </div>
        <div class="relative p-5 text-gray-800 font-medium min-h-[100px]">
          <span>{{ $item->title }}</span>
        </div>
      </a>
    @endforeach
  </div>
</div>
@endsection
