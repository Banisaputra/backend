@extends('layouts.admin')

@section('title', 'Galeri')

@section('title_with_action')
<span class="text-3xl font-bold text-teal-700">Galeri</span>
@permission('galleries-create')
  <x-button as="link" href="{{ route('galleries.create') }}" label="Buat Album" theme="outline" size="sm">
    <x-slot name="leftIcon">
      <x-heroicon-s-plus class="w-5 h-5 mr-2" />
    </x-slot>
  </x-button>
@endpermission
@endsection

@section('content')
<x-admin.data-viewer searchByKey="title">
  @if ($galleries->isEmpty())
    <div class="text-center py-24 text-gray-500 bg-gray-50 text-sm">Tidak ada data yang dapat ditampilkan</div>
  @else
    <div class="grid lg:grid-cols-3 2xl:grid-cols-5 gap-5">
      @foreach ($galleries as $item)
        @php
          $firstImage = collect($item->content)->where('type', 'image')->first();
        @endphp
        <div class="relative group border border-gray-200 rounded-lg overflow-hidden">
          <a href="{{ route('galleries.edit', ['gallery' => $item->slug]) }}" class="block relative h-48">
            @if ($firstImage)
              <img alt="" class="object-cover object-center w-full h-full block" src="{{ $firstImage->data->file->url }}">
            @else
              <div class="flex items-center justify-center text-sm bg-gray-200 text-gray-400 h-full">No image available</div>
            @endif
          </a>
          <div class="relative p-5 text-gray-800 text-sm font-medium bg-gray-50 flex items-center">
            <x-checkbox data-checkbox-row x-model="selectedItems" name="" :value="$item->id" />
            <span class="ml-4 leading-relaxed line-clamp-2">{{ $item->title }}</span>
            
            @if (!$item->deleted_at)
              @permission('galleries-delete')
                <x-modal method="post" action="{{ route('posts.destroy', ['post' => $item->id]) }}" :withHeader="false" :withFooter="false">
                  @csrf
                  @method('delete')
                
                  <div class="text-center p-5 flex-auto justify-center">
                    <x-heroicon-s-trash class="w-16 h-16 mx-auto text-red-500" />
                    <div class="text-xl font-bold py-4 ">Hapus Galeri</div>
                    <p class="text-sm text-gray-500 px-8">
                      Apakah anda yakin ingin menghapus galeri <b class="text-green-500">{{ $item->title }}</b>?
                    </p>
                    <p class="text-sm text-gray-500 px-8 mt-1.5">
                      Proses ini tidak dapat dibatalkan.
                    </p>
                  </div>
              
                  <div class="p-3 text-center space-x-2 md:block">
                    <div @click="open = false" class="inline-block cursor-pointer mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:bg-gray-100 transition">
                      Cancel
                    </div>
                    <button class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:bg-red-600 transition">
                      Delete
                    </button>
                  </div>

                  <x-slot name="openButton">
                    <div class="absolute top-1/2 right-0 mr-4 -translate-y-1/2 invisible bg-gray-50 p-2.5 rounded group-hover:visible cursor-pointer">
                      <x-heroicon-o-trash class="w-5 h-5 text-red-500" />
                    </div>
                  </x-slot>
                </x-modal>
              @endpermission
            @endif
          </div>
        </div>
      @endforeach
    </div>
  @endif
</x-admin.data-viewer>
@endsection
