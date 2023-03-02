<div
  x-data="{ show: true }"
  x-show="show"
  {{$attributes->merge([
    'class' => 'bg-red-50 border-l-2 border-l-red-500 border border-gray-100 rounded-lg bg-white px-6 py-4 flex items-center justify-between'
  ])}}
>
  <div class="flex">
    <x-heroicon-s-information-circle class="text-red-500 w-5 h-5 mr-3" />
    <span class="text-gray-700 text-sm">{{ $label }}</span>
  </div>
  <x-heroicon-s-x class="w-4 h-4 text-gray-500 cursor-pointer" @click="show = false" />
</div>