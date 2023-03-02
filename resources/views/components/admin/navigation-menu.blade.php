@php
  $currentResourceName = strtok(Route::current()->getName(), '.');
  $isActive = strpos($menu['route_name'], $currentResourceName) === 0;
@endphp
<div>
  <a href="{{ route($menu['route_name']) }}" @class([
    'text-sm flex items-center p-3 rounded-md group',
    'bg-green-500 text-white' => $isActive,
    'text-gray-500 font-semibold hover:text-teal-600 hover:bg-gray-200 transition duration-200' => !$isActive,
  ])>
    <x-dynamic-component :component="$menu['icon']" class="w-6 h-6" />
    <span class="ml-4 hidden-on-mobile">{{ $menu['label'] }}</span>
  </a>
</div>