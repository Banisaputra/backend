<form class="p-10 bg-gray-50 rounded-b-lg" method="post" route="{{ route('settings.store') }}" enctype="multipart/form-data">
  @csrf

  <div class="space-y-8">
    @foreach (config('settings') as $settings)
      @foreach ($settings as $field)
        @php
          $isCheckboxComponent = $field['component'] === 'checkbox-boolean';
          $isSelectComponent = $field['component'] === 'select';
          $attributes = new \Illuminate\View\ComponentAttributeBag($field['attributes']);
          $currentFieldValue = get_cache($attributes->get('name'));

          // set input initial value from settings cache
          if ($isCheckboxComponent) {
            $attributes = $attributes->merge(['checked' => $currentFieldValue]);
          } else if ($isSelectComponent) {
            $options = $field['options'];
            $model = $options['model'];
            $data = convert_collection_to_select_options($model::get(), $options['label_key'], $options['value_key']);

            $attributes = $attributes->merge(['options' => $data, 'selected' => $currentFieldValue]);
          } else {
            $attributes = $attributes->merge(['value' => $currentFieldValue]);
          }
        @endphp

        <div @class([ 'md:grid md:grid-cols-12', 'items-center' => $isCheckboxComponent ])>
          {{-- Field label --}}
          <div @class([ 'col-span-5 xl:col-span-3 2xl:col-span-2 text-sm font-medium leading-relaxed', 'md:mt-3' => !$isCheckboxComponent ])>
            <span class="text-gray-600">{{ $field['title'] }}</span>

            @if (array_key_exists('description', $field))
              <div class="text-sm text-gray-400 mt-2 font-normal pr-5 leading-relaxed">
                {{ $field['description'] }}
              </div>
            @endif
          </div>

          {{-- Field input --}}
          <div class="col-span-7 2xl:col-span-5">
            <x-dynamic-component {{ $attributes }} :component="$field['component']" />
          </div>
        </div>
      @endforeach

      @if (!$loop->last)
        <div class="border-t border-gray-300 my-10"></div>
      @endif
    @endforeach
  </div>

  <div class="md:grid md:grid-cols-12">
    <div class="col-span-7 col-start-4 2xl:col-span-5 2xl:col-start-3">
      <x-button class="py-3 px-8 mt-10" label="Simpan">
        <x-slot name="leftIcon">
          <x-heroicon-s-save class="w-5 h-5 text-white mr-3" />
        </x-slot>
      </x-button>
    </div>
  </div>
</form>