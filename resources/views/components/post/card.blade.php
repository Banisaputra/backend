@props([
  'class' => '',
  'post' => collect([]),
])

@php
  $paragraph = collect($post->content)->where('type', 'paragraph')->first();
@endphp

<div @class([
  'bg-white border border-gray-200 flex flex-col p-6 rounded-lg min-h-[170px] text-xl',
  $class,
])>
  <a href="{{ route('post', ['slug' => $post->slug]) }}" class="text-gray-900 font-bold leading-relaxed mb-2.5 hover:text-green-500 transition-colors duration-200">
    {{ ucwords(strtolower($post->title)) }}
  </a>
  @if ($paragraph)
    <div class="mb-10">
      <p class="text-sm text-gray-500">{{ \Str::limit(html_entity_decode(strip_tags($paragraph->data->text)), 150) }}</p>
    </div>
  @endif
  <div class="flex items-center space-x-8 text-sm mt-auto">
    <div class="text-gray-400 flex items-center text-xs sm:text-md">
      <x-heroicon-s-calendar class="w-4 sm:w-5 h-4 sm:h-5 mr-2" />
      <span>{{ \Carbon\Carbon::parse($post->created_at)->translatedFormat(get_cache('date_time_format')) }}</span>
    </div>
    <div class="text-gray-400 flex items-center text-xs sm:text-md">
      <x-heroicon-s-user class="w-4 sm:w-5 h-4 sm:h-5 mr-2" />
      <span>{{ $post->author->display_name }}</span>
    </div>
  </div>
</div>
