@extends('layouts.default')

@section('title', ucwords(strtolower($post->title)))
<?php
$contentText = array_filter($post->content, function($obj){
    if ($obj->type === 'paragraph') {
        return true;
    }
    
    return false;
});
?>

@if (count($contentText) > 0)
    @section('meta_description', substr(array_values($contentText)[0]->data->text,0,150).'...')
@endif

@section('content')
  @if ($post->type === 'page')
    @include('posts.page', ['page' => $post])
  @elseif ($post->type === 'gallery')
    @include('posts.gallery', ['gallery' => $post])
  @else
    @php
      $recentPosts = \App\Models\Post::with('author')
          ->where('type', 'article')
          ->where('status', 'published')
          ->where('id', '<>', $post->id)
          ->orderBy('id', 'desc')
          ->limit(8)
          ->get();
    @endphp
    @include('posts.article', ['post' => $post, 'recentPosts' => $recentPosts])
  @endif
  


@endsection

@push('head')
<link rel="stylesheet" href="https://unpkg.com/@tailwindcss/typography@0.1.2/dist/typography.min.css">
@endpush