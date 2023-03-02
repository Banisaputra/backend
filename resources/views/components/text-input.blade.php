<?php
$error = !empty($validationBagName) ? $errors->getBag($validationBagName) : $errors;
?>
<div class="w-full" x-data="{ show: false, type: '{{ $type }}' }">
  @if ($label)
    <label for="{{$name}}" class="block text-gray-700 text-sm font-normal mb-2">
      {{$label}}

      @if ($attributes['required'])
        <span class="text-red-500">*</span>
      @endif
    </label>
  @endif

  <div class="relative">
    <input
      id="{{$name}}"
      name="{{$name}}"
      placeholder="{{$placeholder}}"
      value="{{$attributes['value'] ?? old($name, '')}}"
      x-bind:type="type === 'password' && show ? 'text' : type"
      {{
        $attributes->class([
          'w-full rounded py-2.5 px-4 border outline-none focus-visible:shadow-none focus:border-green-500 placeholder-gray-300 disabled:text-gray-600',
          'border-grey-500' => !$error->has($name),
          'border-red-500' => $error->has($name),
          '!pr-10' => $error->has($name) || $type === 'password',
        ])->merge()
      }}
    />
  
    @if($type === 'password')
      <div class="absolute right-0 top-1/2 -translate-y-1/2 mr-4" @click="show = !show">
        <template x-if="show">
          <x-heroicon-s-eye-off class="cursor-pointer ml-3 w-5 h-5 text-gray-400 select-none" />
        </template>

        <template x-if="!show">
          <x-heroicon-s-eye class="cursor-pointer ml-3 w-5 h-5 text-gray-400 select-none" />
        </template>
      </div>
    @endif
  </div>

  @if ($helperText)
    <div class="text-gray-400 text-xs mt-2 leading-relaxed max-w-sm">
      {{ $helperText }}
    </div>
  @endif

  @if ($error->first($name))
    <span class="flex items-center tracking-wide text-red-500 text-xs mt-2">
      {{ $error->first($name) }}
    </span>
  @endif
</div>