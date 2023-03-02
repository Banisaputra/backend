@php
  $items = collect($items)->filter(function ($item) {
    if (!array_key_exists('role', $item) && !array_key_exists('permission', $item)) {
      return true;
    }

    $hasRole = array_key_exists('role', $item) && Auth()->user()->isA($item['role']);
    $hasPermissions = array_key_exists('permission', $item) && Auth()->user()->isAbleTo($item['permission']);

    if ($hasRole || $hasPermissions) {
      return $item;
    }
  });

  $defaultActiveTab = $items->where('selected', true)->first() ?? $items->first();
@endphp

<div x-data="{ tab: '{{ $defaultActiveTab['label'] }}' }">
  <div class="border-b border-gray-200">
    <nav class="inline-flex items-center rounded-t-lg overflow-hidden divide-x">
      @foreach ($items as $item)
        @role($item['role'] ?? [])
          @permission($item['permission'] ?? [])
            <a
              href="#"
              @click.prevent="tab = '{{ $item['label'] }}'"
              class="cursor-pointer py-3 px-8 border-gray-300"
              :class="
                tab === '{{ $item['label'] }}'
                  ? 'bg-green-500 text-white'
                  : 'text-gray-500 bg-gray-200'"
            >
              {{ $item['label'] }}
            </a>
          @endpermission
        @endrole
      @endforeach
    </nav>
  </div>
  
  <div class="overflow-hidden" x-cloak>
    @foreach ($items as $item)
      @role($item['role'] ?? [])
        @permission($item['permission'] ?? [])
          <div
            x-show="tab === '{{ $item['label'] }}'"
            x-transition:enter="transform transition ease-out duration-500"
            x-transition:enter-start="opacity-0 translate-x-8"
            x-transition:enter-end="opacity-100 translate-x-0">
              @include($item['template_location'], $item['props'] ?? [])
          </div>
        @endpermission
      @endrole
    @endforeach
  </div>
</div>
