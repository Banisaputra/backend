<?php
$error = $validationBagName ? $errors->getBag($validationBagName) : $errors;
?>
<div>
  @if ($label)
    <label for="{{$name}}" class="block text-gray-700 text-sm font-normal mb-2">
      {{$label}}

      @if ($attributes['required'])
        <span class="text-red-500">*</span>
      @endif
    </label>
  @endif

  <div class="relative">
    <textarea
      id="{{$name}}"
      name="{{$name}}"
      placeholder="{{$placeholder}}"
      {{
        $attributes->class([
          'w-full rounded py-2.5 pr-10 px-[14px] border outline-none focus-visible:shadow-none focus:border-green-500 placeholder-gray-300',
          'border-grey-500' => !$error->has($name),
          'border-red-500' => $error->has($name)
        ])->merge()
      }}
    >{{$attributes['value'] ?? old($name, '')}}</textarea>
  </div>

  @if ($error->first($name))
    <span class="flex items-center tracking-wide text-red-500 text-xs mt-2 ml-1">
      {{ $error->first($name) }}
    </span>
  @endif
</div>