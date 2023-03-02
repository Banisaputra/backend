<?php
$id = Str::random(9);
?>

<div x-data="{ open: {{ $isOpen ?: 'false' }} }" x-cloak>
  <template x-if="open">
    <div class="fixed inset-0 bg-gray-900/70 z-40"></div>
  </template>

  <div
    x-show="open" 
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="transform scale-75 opacity-0"
    x-transition:enter-end="transform scale-100 opacity-100"
    class="fixed inset-0 flex items-center justify-center text-base z-50">
    <form
      @click.outside="open = false"
      {{
        $attributes->class([
          'w-full flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-lg'
        ])->merge([])
      }}>
      @if ($withHeader)
        <div class="flex items-center justify-between p-6 bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
          <div class="font-semibold text-gray-800">
            {{ $title }}
          </div>
          <x-heroicon-s-x @click="open = false" class="w-6 h-6 cursor-pointer text-gray-500" />
        </div>
      @endif
      
      <div
        @class([
          'flex flex-col px-6 py-5 max-h-[calc(100vh-222px)] overflow-y-auto',
          'rounded-t-lg' => !$withHeader,
          'rounded-b-lg' => !$withFooter,
          'bg-gray-50' => ($withHeader && $withFooter),
          'bg-white' => (!$withHeader && !$withFooter)
        ])
      >
        {{ $slot }}
      </div>

      @if ($withFooter)
        <div class="flex flex-row items-center justify-between px-6 py-4 bg-white border-t border-gray-200 rounded-bl-lg rounded-br-lg">
          <div @click="open = false" class="text-sm font-semibold text-gray-600 cursor-pointer">Cancel</div>
          {{ $submit_button }}
        </div>
      @endif
    </form>
  </div>

  @if ($openButton)
    <div x-modal-button="modal-{{$id}}" @click="open = true">
      {{ $openButton }}
    </div>
  @endif
</div>