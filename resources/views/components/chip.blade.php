@props(['active' => false])

<div {{ $attributes->merge() }} class="rounded-full focus:outline-none focus:ring-2 focus:bg-green-50 focus:ring-green-800 cursor-pointer select-none">
  <div class="py-1.5 px-5 text-sm rounded-full text-gray-600 hover:text-green-700 hover:bg-green-100">
    {{ $slot }}
  </div>
</div>