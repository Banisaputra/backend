@php
  $resources = array_unique($permissions->map(function ($permission) {
    return str_replace(['create', 'read', 'update', 'delete'], '', $permission->name);
  })->toArray());

  $permissionsByResource = [];
  foreach (collect($resources) as $resource) {
    $permissionsByResource[$resource] = $permissions->filter(function ($query) use ($resource) {
      return Str::startsWith($query->name, $resource);
    });
  }
@endphp
<div class="p-10 bg-gray-50 rounded-b-lg">
  <div class="flex justify-end mb-8">
    <x-modal :isOpen="$errors->roleStoreForm->any()" method="post" :action="route('rbac.store')" title="Buat Role">
      @csrf
    
      <div class="space-y-5">
        <x-text-input validationBagName="roleStoreForm" required label="Nama" name="display_name" type="text" />
        <x-text-area rows="3" validationBagName="roleStoreForm" label="Deskripsi" name="description" type="text" />
      </div>
  
      <x-slot name="submit_button">
        <x-button label="Tambah">
          <x-slot name="leftIcon">
            <x-heroicon-s-plus-circle class="w-4 h-4 mr-2.5" />
          </x-slot>
        </x-button>
      </x-slot>
  
      <x-slot name="openButton">
        <x-button label="Buat Role" theme="outline">
          <x-slot name="leftIcon">
            <x-heroicon-s-plus class="w-5 h-5 mr-2" />
          </x-slot>
        </x-button>
      </x-slot>
    </x-modal>
  </div>

  <div class="mb-20 overflow-x-auto">
    <x-admin.data-table
      :withCheckboxes="false"
      :columns="[
        [
          'label' => 'Nama',
          'field' => 'name',
        ],
        [
          'label' => 'Deskripsi',
          'field' => 'description',
          'classes' => 'py-4 px-6 lg:px-10 xl:pr-20',
        ],
      ]"
      :rows="$roles->map(function ($role) {
        return collect([
          'collection' => $role,
          'actions' => [
            'edit' => route('rbac.edit', ['rbac' => $role->id]),
          ],
          'name' => [
            'value' => $role->display_name,
          ],
          'description' => [
            'value' => \Str::words($role->description ?? '-', 7),
            'classes' => 'py-4 px-6 lg:px-10 xl:pr-20',
          ],
        ]);
      })"
    />
  </div>

  <form action="{{route('roles.update')}}" method="post">
    @csrf

    <h3 class="text-lg font-medium text-gray-600 mb-8">Edit Role Based Access Control</h3>
    <table class="w-full table-fixed rounded-md overflow-hidden">
      <thead>
        <tr class="rounded-lg border text-sm font-medium text-gray-700 text-left">
          <th class="bg-gray-100 border py-3 text-sm font-normal w-20 text-center" rowspan="2">Permissions</th>
          <th class="bg-gray-100 border py-3 text-sm font-normal w-20 text-center" colspan="{{count($roles)}}">Roles</th>
        </tr>
        <tr class="rounded-lg border text-sm font-medium text-gray-700 text-left">
          @foreach ($roles as $role)
            <th class="bg-gray-100 border py-3 text-sm font-normal w-20 text-center">
              {{ $role->display_name }}
            </th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        @foreach ($permissionsByResource as $resource => $permissions)
          <tr class="focus:outline-none border border-green-500 bg-green-500/10 rounded">
            <td class="border py-4 px-8 text-green-500 font-medium" colspan="{{count($roles) + 1}}">
              {{ ucwords(str_replace('-', ' ', $resource)) }}
            </td>
          </tr>
          @foreach ($permissions as $permission)
            <tr class="focus:outline-none h-16 border border-gray-100 odd:bg-white even:bg-gray-50 rounded">
              <td class="border py-3 px-8">
                {{ $permission->display_name }}
              </td>
              @foreach ($roles as $role)
                <td class="border py-3 px-4">
                  <div class="flex items-center justify-center">
                    <x-checkbox
                      name="roles[{{$role->name}}][]"
                      :value="$permission->id"
                      :checked="!!$role->permissions->where('name', $permission->name)->first()"
                    />
                  </div>
                </td>
              @endforeach
          @endforeach
        @endforeach
      </tbody>
    </table>

    <x-button class="mt-10 ml-auto" label="Save">
      <x-slot name="leftIcon">
        <x-heroicon-s-save class="w-5 h-5 mr-2.5" />
      </x-slot>
    </x-button>
  </form>
</div>
