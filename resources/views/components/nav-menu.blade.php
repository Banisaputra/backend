@php
  $targetUrl = $menu->object_type === 'custom_link' ? $menu->object_value : route('post', ['slug' => $menu->page->slug]);
  if ($menu->object_type === 'custom_link' && !str_starts_with($targetUrl, 'http')) {
    $targetUrl = url($targetUrl);
  }

  $isActive = Request::is($targetUrl) || Request::url() === $targetUrl;
@endphp
<a
  href="{{ $targetUrl }}"
  @class([
    'text-lg leading-6 mx-0 lg:mx-5 my-4 lg:my-0 relative hover:text-green-500 transition',
    'text-green-500 font-medium after:w-2 after:h-1 after:rounded-full after:bg-green-500 after:absolute after:-bottom-1.5 after:left-1/2 after:-translate-x-1/2' => $isActive,
    'text-gray-500' => !$isActive,
  ])>
  {{ $menu->label }}
</a>
