<table class="w-full table-fixed rounded-md overflow-hidden">
  <thead>
    <tr class="rounded-lg text-sm font-medium text-gray-700 text-left">
      <th class="bg-gray-100 py-3 text-sm font-normal w-20 text-center">
        @if (!$rows->isEmpty() && $withCheckboxes)
          <div class="flex justify-center items-center">
            <x-checkbox @click="selectAllCheckboxes" x-model="selectedAll" name="check_all" value="" />
          </div>
        @else
          #
        @endif
      </th>

      @foreach ($columns as $column)
        @if (array_key_exists('sort', $column))
          <th @click="sortData('{{$column['field']}}'), applyFilter()" @class([ 'bg-gray-100 py-3 px-4 text-sm font-normal cursor-pointer', $column['classes'] ?? null ])>
            <span>{{ $column['label'] }}</span>

            <template x-if="sort?.by === '{{$column['field']}}'">
              <span>
                <template x-if="sort?.position === 'asc'">
                  <x-heroicon-s-arrow-up class="inline-block text-gray-600 -mt-0.5 w-3.5 h-3.5 ml-2" />
                </template>
  
                <template x-if="sort?.position === 'desc'">
                  <x-heroicon-s-arrow-down class="inline-block text-gray-600 -mt-0.5 w-3.5 h-3.5 ml-2" />
                </template>
              </span>
            </template>
          </th>
        @else
          <th @class([ 'bg-gray-100 py-3 px-4 text-sm font-normal', $column['classes'] ?? null ])>
            {{ $column['label'] }}
          </th>
        @endif
      @endforeach

      @if ($withActions)
        <th class="bg-gray-100 py-3 px-4 text-sm font-normal hidden 2xl:table-cell">Action</th>
      @endif
    </tr>
  </thead>
  <tbody>
    @foreach ($rows as $index => $row)
      <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 odd:bg-white even:bg-gray-50 hover:bg-gray-100/75 rounded">
        <td class="w-20">
          <div class="flex justify-center items-center">
            @if ($withCheckboxes)
              <x-checkbox data-checkbox-row x-model="selectedItems" name="" :value="$row->get('collection')->id" />
            @endif
          </div>
        </td>

        @foreach ($columns as $column)
          <td @class(['p-4 text-sm leading-relaxed text-gray-600', $row->get($column['field'])['classes'] ?? null])>
            @if (array_key_exists('link', $row->get($column['field'], [])))
              <a href="{{$row->get($column['field'])['link']}}" class="font-medium hover:text-green-500 transition duration-200">
                {{ $row->get($column['field'])['value'] ?? null }}
              </a>
            @else
              {{ $row->get($column['field'])['value'] ?? null }}
            @endif

            @if ($row->get($column['field'])['primary_label'] ?? false)
              <div class="2xl:hidden mt-2.5">
                <x-admin.data-table-action :row="$row" />
              </div>
            @endif
          </td>
        @endforeach
        
        @if ($withActions)
          <td class="py-3 px-4 hidden 2xl:table-cell">
            <x-admin.data-table-action :row="$row" />
          </td>
        @endif
      </tr>
    @endforeach
  </tbody>

  @if (!$rows->isEmpty())
    <thead>
      <tr class="rounded-lg text-sm font-medium text-gray-700 text-left">
        <th class="bg-gray-100 py-3 text-sm font-normal w-20 text-center">
          @if ($withCheckboxes)
            <div class="flex justify-center items-center">
              <x-checkbox @click="selectAllCheckboxes" x-model="selectedAll" name="check_all" value="" />
            </div>
          @else
            #
          @endif
        </th>

        @foreach ($columns as $column)
          <th @class(['bg-gray-100 py-3 px-4 text-sm font-normal', $column['classes'] ?? null])>
            {{ $column['label'] }}
          </th>
        @endforeach

        @if ($withActions)
          <th class="bg-gray-100 py-3 px-4 text-sm font-normal hidden 2xl:table-cell">Action</th>
        @endif
      </tr>
    </thead>
  @endif
</table>

@if ($rows->isEmpty())
  <div class="text-center py-24 text-gray-500 bg-gray-50 text-sm">Tidak ada data yang dapat ditampilkan</div>
@endif
