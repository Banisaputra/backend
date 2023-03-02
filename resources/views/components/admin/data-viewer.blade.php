<div x-data="posts()">
  <div class="sm:flex items-end justify-between">
    <div>
      @if ($withFilter)
        <div class="text-gray-500 text-sm mb-2.5">Filter berdasarkan</div>
        <div class="flex items-center space-x-1.5">
          <x-chip
            ::class="!filters?.filter?.status && !filters?.filter?.trashed ? 'bg-green-100 text-green-700' : ''"
            @click="assignFilter({ filter: {} }), applyFilter()">
            All
          </x-chip>
          <x-chip
            ::class="filters?.filter?.status === 'published' ? 'bg-green-100 text-green-700' : ''"
            @click="assignFilter({ filter: { status: 'published' } }), applyFilter()">
            Published
          </x-chip>
          <x-chip
            ::class="filters?.filter?.status === 'draft' ? 'bg-green-100 text-green-700' : ''"
            @click="assignFilter({ filter: { status: 'draft' } }), applyFilter()">
            Drafts
          </x-chip>
          <x-chip
            ::class="filters?.filter?.trashed === 'only' ? 'bg-green-100 text-green-700' : ''"
            @click="assignFilter({ filter: { trashed: 'only', status: null } }), applyFilter()">
            Trashed
          </x-chip>
        </div>
      @endif
    </div>
    
    @if ($searchByKey)
      <div class="flex items-center ml-6">
        <x-text-input
          @input="mergeFilter({ filter: { {{$searchByKey}}: $event.target.value } })"
          @keyup.enter="applyFilter"
          x-bind:value="filters?.filter?.{{$searchByKey}}"
          class="!py-1.5 placeholder:!text-sm"
          name="search_query"
          placeholder="Search..."
          type="text" />
        <x-button @click="applyFilter" class="ml-3 !rounded-md" label="Search items" size="sm" theme="outline" />
      </div>
    @endif
  </div>

  <div class="mt-8 overflow-x-auto">
    {{ $slot }}
  </div>

  @if ($withBulkAction)
    <template x-if="selectedItems.length > 0">
      <form method="post" action="{{route('posts.bulkaction')}}" class="fixed m-5 bottom-0 left-0 right-0 bg-white py-2.5 px-5 shadow rounded-lg z-40" ::class="filters?.filter?.trashed ? 'border-red-500' : 'border-blue-500'">
        @csrf

        <template x-for="item in selectedItems">
          <x-text-input type="hidden" name="post_id[]" x-bind:value="item" />
        </template>

        <x-text-input type="hidden" name="action" x-bind:value="bulkAction" />
        
        <div class="flex items-center justify-between">
          <div class="flex items-center">
            <x-heroicon-o-information-circle class="w-5 h-5 mr-4 text-green-500" />
            <div>
              <span x-text="selectedItems.length"></span>
              <span x-text="selectedItems.length > 1 ? 'items' : 'item'"></span>
              <span>selected</span>
            </div>
          </div>

          <div class="flex items-center">
            <template x-if="!filters?.filter?.trashed">
              <x-select x-model="bulkAction" placeholder="Select an action" name="action_options" :options="[
                ['label' => 'Move to trash', 'value' => 'trash'],
                ['label' => 'Publish post', 'value' => 'published'],
                ['label' => 'Switch to draft', 'value' => 'draft']]"
              />
            </template>
            <template x-if="filters?.filter?.trashed">
              <x-select x-model="bulkAction" name="action_options" :options="[['label' => 'Restore', 'value' => 'restore']]" placeholder="Select an action" />
            </template>

            <x-button class="ml-3" label="Apply" theme="outline" x-bind:disabled="!bulkAction" />
          </div>
        </div>
      </form>
    </template>
  @endif
</div>
