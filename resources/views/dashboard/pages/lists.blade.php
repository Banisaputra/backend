@extends('layouts.admin')

@section('title', 'Halaman')

@section('title_with_action')
<span class="text-3xl font-bold text-teal-700">Halaman</span>
@permission('pages-create')
  <x-button as="link" href="{{route('pages.create')}}" label="Buat Baru" theme="outline" size="sm">
    <x-slot name="leftIcon">
      <x-heroicon-s-plus class="w-5 h-5 mr-2" />
    </x-slot>
  </x-button>
@endpermission
@endsection

@section('content')
@php
  $canView = Auth()->user()->isAbleTo('pages-read');
  $canDelete = Auth()->user()->isAbleTo('pages-delete');
@endphp
<x-admin.data-viewer searchByKey="title">
  <x-admin.data-table
    :withActions="$canView || $canDelete"
    :columns="[
      [
        'label' => 'Title',
        'field' => 'title',
        'classes' => 'w-2/5 lg:w-5/12 2xl:w-1/4 lg:px-10',
      ],
      [
        'label' => 'Status',
        'classes' => 'hidden xl:table-cell',
        'field' => 'status',
      ],
      [
        'label' => 'Views',
        'classes' => 'w-32 hidden 2xl:table-cell',
        'field' => 'view_count',
      ],
      [
        'label' => 'Date',
        'field' => 'date',
      ],
    ]"
    :rows="$pages->getCollection()->map(function ($page) use ($canDelete, $canView) {
      return collect([
        'collection' => $page,
        'actions' => [
          'delete' => $canDelete ? route('posts.destroy', ['post' => $page->id]) : null,
          'view' => $canView ? route('post', ['slug' => $page->slug]) : null,
        ],
        'title' => [
          'value' => $page->title,
          'classes' => 'group py-3 px-6 lg:px-10 xl:pr-20 2xl:pr-36',
          'link' => route('pages.edit', ['page' => $page->slug]),
          'primary_label' => true,
        ],
        'status' => [
          'value' => ucwords($page->status),
          'classes' => 'hidden xl:table-cell',
        ],
        'view_count' => [
          'value' => $page->view_count,
          'classes' => 'hidden 2xl:table-cell',
        ],
        'date' => [
          'value' => \Carbon\Carbon::parse($page->created_at)->translatedFormat(get_cache('date_time_format')),
        ]
      ]);
    })"
  />

  {{ $pages->links('components.pagination') }}
</x-admin.data-viewer>
@endsection
