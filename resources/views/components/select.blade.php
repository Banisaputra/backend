<div>
  @if ($label)
    <label for="{{$name}}" class="block text-gray-700 text-sm font-normal mb-2">
      {{$label}}

      @if ($attributes['required'])
        <span class="text-red-500">*</span>
      @endif
    </label>
  @endif

  <select
    name="{{ $name }}"
    {{ $attributes
        ->merge([
          'class' => 'form-select block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding bg-no-repeat border border-solid border-gray-300 rounded transition ease-in-out my-0 focus:text-gray-700 focus:bg-white focus:border-green-500 focus:outline-none'
        ])
    }}>
    @if ($placeholder)
      <option value="" selected>{{ $placeholder }}</option>
    @endif

    @foreach ($options as $item)
      <option value="{{ $item['value'] }}" {{$item['value'] === $selected ? 'selected' : ''}}>
        {{ $item['label'] }}
      </option>
    @endforeach
  </select>
</div>