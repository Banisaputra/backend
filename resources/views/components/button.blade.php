@php
  $styles = [
    'theme' => [
      'default' => [
        'button' => 'text-white bg-green-500 hover:bg-green-500/80 hover:border-green-500/80',
        'icon' => 'text-white',
      ],
      'danger' => [
        'button' => 'text-white bg-red-500 hover:bg-red-600 border-red-500',
        'icon' => 'text-white',
      ],
      'outline' => [
        'button' => 'text-green-500 bg-white hover:bg-green-100',
        'icon' => 'text-green-500',
      ],
    ],
    'size' => [
      'default' => 'py-3 px-5 text-base',
      'sm' => 'py-2 px-3 text-sm',
    ],
  ];

  $attributes = $attributes->class([
    'min-w-[120px] flex items-center justify-center rounded-md border border-green-500 transition disabled:!text-gray-400 disabled:!bg-gray-300 disabled:!border-gray-300 disabled:hover:!bg-gray-300 disabled:cursor-not-allowed',
    $styles['theme'][$theme]['button'],
    $styles['size'][$size],
 ])->merge();
@endphp

@if ($attributes->get('as') === 'link')
<a {{ $attributes }} href="{{$attributes->get('href')}}">
  @if (!empty($leftIcon))
    <div class="{{$styles['theme'][$theme]['icon']}}">
      {{ $leftIcon }}
    </div>
  @endif

  {{ $label }}
</a>
@else
<button type="submit" {{ $attributes }}>
  @if (!empty($leftIcon))
    <div class="{{$styles['theme'][$theme]['icon']}}">
      {{ $leftIcon }}
    </div>
  @endif

  {{ $label }}
</button>
@endif