<div class="p-10 bg-gray-50 rounded-b-lg">
  <div class="flex justify-end">
    {{-- Create Category Form --}}
    @permission('categories-create')
      <x-modal :isOpen="$errors->categoryStoreForm->any()" method="post" :action="route('categories.store')" title="Tambah Kategori Baru">
        @csrf
      
        <div class="space-y-5">
          <x-text-input validationBagName="categoryStoreForm" required label="Nama" name="name" type="text" />
          <x-text-area rows="3" validationBagName="categoryStoreForm" label="Deskripsi" name="description" type="text" />
        </div>
    
        <x-slot name="submit_button">
          <x-button label="Tambah">
            <x-slot name="leftIcon">
              <x-heroicon-s-plus-circle class="w-4 h-4 mr-2.5" />
            </x-slot>
          </x-button>
        </x-slot>
    
        <x-slot name="openButton">
          <x-button label="Tambah Kategori" theme="outline">
            <x-slot name="leftIcon">
              <x-heroicon-s-plus class="w-5 h-5 mr-2" />
            </x-slot>
          </x-button>
        </x-slot>
      </x-modal>
    @endpermission
  </div>

  <div class="mt-8 overflow-x-auto">
    <x-admin.data-table
      :withCheckboxes="false"
      :columns="[
        [
          'label' => 'Nama',
          'field' => 'name',
          'sort' => true,
        ],
        [
          'label' => 'Deskripsi',
          'field' => 'description',
          'classes' => 'py-4 px-6 lg:px-10 xl:pr-20',
        ],
        [
          'label' => 'Jumlah Post',
          'field' => 'post_count',
          'classes' => 'w-40',
        ],
      ]"
      :rows="$categories->map(function ($category) {
        return collect([
          'collection' => $category,
          'actions' => [
            'delete' => route('categories.destroy', ['category' => $category->id]),
            'edit' => route('categories.edit', ['category' => $category->id]),
          ],
          'name' => [
            'value' => $category->name,
            'link' => route('categories.edit', ['category' => $category->slug]),
          ],
          'description' => [
            'value' => \Str::words($category->description ?? '-', 7),
            'classes' => 'py-4 px-6 lg:px-10 xl:pr-20',
          ],
          'post_count' => [
            'value' => $category->posts_count,
            'classes' => 'w-40',
          ],
        ]);
      })"
    />
  </div>
</div>
