@extends('layouts.default')

@section('title', 'Berita & Artikel')

@section('content')
<div class="container px-4 py-24 mx-auto">
  <div class="md:grid md:grid-cols-12 md:gap-12">
    <div class="md:col-span-8 2xl:col-span-9">
      <div>
        <div class="border-l-4 border-green-500 pl-3 mb-5 text-gray-800 font-medium">
          Berita & Artikel
        </div>
        @if (request()->input('filter.q'))
          <p class="italic text-sm text-gray-600">
            Menampilkan artikel dengan kata kunci: <u><i>{{ request()->input('filter.q') }}</i></u>
          </p>
        @endif
        @if (!$posts->isEmpty())
          <div class="md:grid md:grid-cols-2 gap-6 space-y-4 md:space-y-0 mt-10">
            @foreach ($posts as $post)
              <x-post.card :post="$post" class="!bg-gray-50/75 !pt-3.5 !pb-5 !px-5 !text-lg !border-t-2 !border-t-green-500" />
            @endforeach
          </div>
        @else
          <div class="bg-gray-50/50 rounded-lg p-24 flex items-center justify-center mt-10">
            Tidak ada artikel yang dapat ditampilkan.
          </div>
        @endif
      </div>

      {{ $posts->links('components.pagination') }}
    </div>

    <div class="md:col-span-4 2xl:col-span-3 space-y-12">
      <div>
        <div class="border-l-4 border-green-500 pl-3 mb-5 text-gray-500">
          Cari berdasarkan:
        </div>
        <form action="{{route('blog')}}" class="flex items-center space-x-4">
          <x-text-input class="!py-1.5" name="filter[q]" :value="request()->input('filter.q')" type="text" />
          <x-button size="sm" theme="outline" label="Cari" />
        </form>
      </div>

      <div>
        <div class="flex items-center font-medium mt-10 md:mt-0 bg-green-500 text-white rounded-lg py-3 px-5 mb-3">
          <div class="w-1.5 h-1.5 rounded-full bg-white mr-3"></div>
          <div>Categories</div>
        </div>
        <div class="space-y-1.5">
          @foreach ($categories as $category)
            <a href="{{route('category', ['slug' => $category->slug])}}" class="block rounded-lg py-4 px-5 flex items-center border border-gray-100 hover:bg-gray-100 transition duration-200">
              <span class="mr-2.5 text-gray-800 font-light text-sm">#</span>
              <span class="block text-green-500 ">
                {{ $category->name }}
              </span>
            </a>
          @endforeach
        </div>
      </div>

      <div>
        <div class="flex items-center font-medium mt-10 md:mt-0 bg-green-500 text-white rounded-lg py-3 px-5 mb-3">
          <div class="w-1.5 h-1.5 rounded-full bg-white mr-3"></div>
          <div>Archives</div>
        </div>
        <div class="space-y-1.5">
          @foreach ($archives as $archive)
            @php
              $date = \Carbon\Carbon::createFromDate($archive->year, $archive->month, 1);
            @endphp
            <a href="{{ route('blog', ['filter' => ['date' => $date->translatedFormat('m-Y') ]]) }}" class="block rounded-lg mt-1.5 py-4 px-5 border border-gray-100 text-gray-700 hover:bg-gray-50 transition duration-200">
              <span class="text-green-500">
                {{ $date->translatedFormat('F Y'); }}
              </span>
              <span class="text-gray-800">({{ $archive->posts }})</span>
            </a>
          @endforeach
        </div>
      </div>
    </div>

  </div>
</div>
@endsection
