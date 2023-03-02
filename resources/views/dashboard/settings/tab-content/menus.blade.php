@php
  $pages = \App\Models\Post::where('type', 'page')->get();
@endphp

<div class="p-10 bg-gray-50 rounded-b-lg" x-data="menus()">
  <div class="md:grid md:grid-cols-12 gap-10">
    <div class="col-span-5 2xl:col-span-4 space-y-4">
      <div class="bg-white rounded-lg overflow-hidden border border-gray-200">
        <div class="flex items-center bg-gray-100 px-6 py-3 border-b border-gray-200">
          <x-heroicon-o-collection class="w-4 h-4 mr-3 text-gray-500" />
          Pages
        </div>
        <div class="p-6 space-y-4 max-h-[250px] overflow-y-auto">
          @if ($pages->isEmpty())
            <div class="text-sm text-gray-400 my-6">Tidak ada halaman yang dapat dipilih</div>
          @endif

          @foreach ($pages as $page)
            <x-checkbox
              name="page"
              value=""
              :label="$page->title"
              @change="selectPage({{ json_encode($page->only('id', 'title')) }})"
            />
          @endforeach
        </div>
        <div class="px-5 py-3 bg-gray-100 border-t border-gray-200">
          <x-button
            @click="addPageToMenu"
            label="Add to menu"
            size="sm"
            theme="outline"
            x-bind:disabled="selectedPages.length === 0"
          />
        </div>
      </div>

      <div class="bg-white rounded-lg overflow-hidden border border-gray-200">
        <div class="flex items-center bg-gray-100 px-6 py-3 border-b border-gray-200">
          <x-heroicon-o-link class="w-4 h-4 mr-3 text-gray-500" />
          Custom Links
        </div>
        <div class="p-6 space-y-4 max-h-[250px] overflow-y-auto">
          <div class="md:grid md:grid-cols-12">
            <label class="col-span-5 xl:col-span-3 text-sm md:mt-2.5">Label</label>
            <div class="col-span-7 xl:col-span-9 mt-2.5 md:mt-0">
              <x-text-input x-model="customLink.label" name="custom_link_label" type="text" />
            </div>
          </div>
          <div class="md:grid md:grid-cols-12">
            <label class="col-span-5 xl:col-span-3 text-sm md:mt-2.5">URL</label>
            <div class="col-span-7 xl:col-span-9 mt-2.5 md:mt-0">
              <x-text-input x-model="customLink.object_value" name="custom_link_url" type="text" placeholder="https://" />
            </div>
          </div>
        </div>
        <div class="px-5 py-3 bg-gray-100 border-t border-gray-200">
          <x-button
            @click="addCustomLinkToMenu"
            label="Add to menu"
            size="sm"
            theme="outline"
            x-bind:disabled="!customLink.label || !customLink.object_value"
          />
        </div>
      </div>
    </div>

    <div class="col-span-7 2xl:col-span-8">
      <form action="{{ route('menus.store') }}" method="post">
        @csrf

        <ul x-ref="sortable" class="mb-5">
          <template x-for="(menu, index) in menus">
            <li class="border border-gray-200 rounded overflow-hidden mb-3">
              <div class="flex justify-between items-center bg-gray-100 py-1.5 px-5 cursor-move menu-header">
                <div class="flex items-center">
                  <x-heroicon-o-selector class="w-4 h-4 mr-2" />
                  <input type="hidden" x-bind:name="`object_type[${index}]`" x-bind:value="menu.object_type" />
                  <x-text-input name="" x-model="menus[index].label" class="bg-gray-100 border-0" type="text" x-bind:name="`label[${index}]`"/>
                </div>
                <div class="flex items-center whitespace-nowrap">
                  <span class="text-gray-500 italic text-sm mr-5" x-text="menu.object_type === 'page' ? 'Page' : 'Custom Link'"></span>
                  <x-heroicon-o-trash @click="removeMenu(index)" class="w-4 h-4 text-red-500 cursor-pointer" />
                </div>
              </div>

              <template x-if="menu.object_type === 'page'">
                <input type="hidden" x-bind:name="`object_value[${index}]`" x-bind:value="menu.object_value" />
              </template>

              <template x-if="menu.object_type === 'custom_link'">
                <div class="flex items-center py-3 px-5 bg-white">
                  <span class="bg-green-100 py-1 px-2 text-xs text-green-500 font-medium rounded-lg">URL:</span>
                  <x-text-input name="" x-model="menus[index].object_value" class="border-0" type="text" x-bind:name="`object_value[${index}]`" />
                </div>
              </template>
            </li>
          </template>
        </ul>

        <x-button label="Save Menu" x-show="menus.length > 0" x-bind:disabled="!dirty" />
      </form>
    </div>
  </div>
</div>
