@extends('layouts.admin')

@section('content')
<div class="grid xl:grid-cols-12 gap-10">
  <div class="col-span-full 2xl:col-span-4">
    <div class="text-white bg-green-500 rounded-lg p-6">
      <div class="text-lg mb-5">Jumlah Post/Artikel</div>
      <div class="flex justify-between 2xl:divide-y 2xl:space-y-2.5 2xl:block">
        <div class="pt-2.5 border-green-700/75">
          <div class="text-sm text-gray-200">Semua Postingan</div>
          <div class="mt-2.5 text-lg">
            {{ $totalPostsCount->total }}
          </div>
        </div>
        <div class="pt-2.5 border-green-700/75">
          <div class="text-sm text-gray-200">Post Terpublikasi</div>
          <div class="mt-2.5 text-lg">
            {{ $totalPostsCount->totalPublished }}
          </div>
        </div>
        <div class="pt-2.5 border-green-700/75">
          <div class="text-sm text-gray-200">Dalam Draft</div>
          <div class="mt-2.5 text-lg">
            {{ $totalPostsCount->totalDrafts }}
          </div>
        </div>
        <div class="pt-2.5 border-green-700/75">
          <div class="text-sm text-gray-200">Post yang Dihapus</div>
          <div class="mt-2.5 text-lg">
            {{ $totalPostsCount->totalTrashed }}
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-span-full 2xl:col-span-8 order-1 2xl:-order-1">
    {!! $chart->container() !!}
  </div>
</div>
@endsection

@push('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
{!! $chart->script() !!}
@endpush
