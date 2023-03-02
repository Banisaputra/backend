@extends('layouts.admin')

@section('title', 'Artikel')

@section('title_with_action')
<span class="text-3xl font-bold text-teal-700">Artikel</span>
@permission('articles-create')
  <x-button as="link" href="{{route('articles.create')}}" label="Buat Baru" theme="outline" size="sm">
    <x-slot name="leftIcon">
      <x-heroicon-s-plus class="w-5 h-5 mr-2" />
    </x-slot>
  </x-button>
@endpermission
@endsection

@section('content')
@php
  $canDelete = Auth()->user()->isAbleTo('articles-delete');
  $canView = Auth()->user()->isAbleTo('articles-read');
@endphp
<x-admin.data-viewer searchByKey="title">
  <x-admin.data-table
    :withActions="$canView || $canDelete"
    :columns="[
      [
        'label' => 'Title',
        'field' => 'title',
        'classes' => 'w-2/5 lg:w-5/12 xl:w-5/12 2xl:w-1/4 lg:px-10',
        'sort' => true,
      ],
      [
        'label' => 'Category',
        'field' => 'category',
        'classes' => 'hidden 2xl:table-cell',
      ],
      [
        'label' => 'Status',
        'field' => 'status',
        'classes' => 'hidden lg:table-cell',
        'sort' => true,
      ],
      [
        'label' => 'Viewers',
        'classes' => 'w-32 hidden xl:table-cell',
        'field' => 'view_count',
      ],
      [
        'label' => 'Date',
        'field' => 'created_at',
        'sort' => true,
      ],
    ]"
    :rows="$articles->getCollection()->map(function ($article) use ($canView, $canDelete) {
      return collect([
        'collection' => $article,
        'actions' => [
          'delete' => $canDelete ? route('posts.destroy', ['post' => $article->id]) : null,
          'view' => $canView ? route('post', ['slug' => $article->slug]) : null,
        ],
        'title' => [
          'value' => ucwords(strtolower($article->title)),
          'classes' => 'py-4 px-6 lg:px-10 xl:pr-20',
          'link' => route('articles.edit', ['article' => $article->slug]),
          'primary_label' => true,
        ],
        'category' => [
          'value' => implode(', ', $article->categories->pluck('name')->toArray()),
          'classes' => 'hidden 2xl:table-cell',
        ],
        'status' => [
          'value' => ucwords($article->status),
          'classes' => 'hidden lg:table-cell',
        ],
        'view_count' => [
          'value' => views($article)->count(),
          'classes' => 'hidden xl:table-cell',
        ],
        'created_at' => [
          'value' => \Carbon\Carbon::parse($article->created_at)->translatedFormat(get_cache('date_time_format')),
        ]
      ]);
    })"
  />

  {{ $articles->links('components.pagination') }}
</x-admin.data-viewer>
@endsection
