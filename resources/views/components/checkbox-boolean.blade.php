@php
$id = Str::random(10);
@endphp

<div id="checkbox-{{$id}}" class="relative" x-data="{ checked: {{ $attributes['checked'] ?: 0 }} }" @unchecked="checked = 0">
  <label class="flex justify-start items-start">
    <div class="bg-white border rounded border-gray-400 w-6 h-6 flex flex-shrink-0 justify-center items-center focus-within:border-green-500">
      <input type="hidden" value="0" name="{{ $name }}">
      <input @input="checked = $el.checked ? 1 : 0" value="1" :checked="checked != 0" type="checkbox" class="opacity-0 absolute" name="{{ $name }}" {{ $attributes->merge() }}>

      <template x-if="checked != 0">
        <svg class="fill-current w-4 h-4 text-green-500 pointer-events-none" viewBox="0 0 20 20">
          <path d="M0 11l2-2 5 5L18 3l2 2L7 18z"/>
        </svg>
      </template>
    </div>
    
    @if ($label)
      <div class="select-none text-sm mt-0.5 ml-2.5">{{ $label }}</div>
    @endif
  </label>

  @error($name)
    <span class="flex items-center tracking-wide text-red-500 text-xs mt-2 ml-1">
      {{ $errors->first($name) }}
    </span>
  @enderror
</div>