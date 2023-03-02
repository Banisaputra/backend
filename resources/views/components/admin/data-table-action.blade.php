@php
  $canEdit = array_key_exists('edit', $row->get('actions', [])) && $row->get('actions')['edit'];
  $canDelete = array_key_exists('delete', $row->get('actions', [])) && $row->get('actions')['delete'];
  $canView = array_key_exists('view', $row->get('actions', [])) && $row->get('actions')['view'];
@endphp

<div class="flex text-sm space-x-6">
  @if ($row->get('collection')->deleted_at)
    <form action="{{ route('posts.untrash', ['post' => $row->get('collection')->id]) }}" method="post">
      @csrf

      <button type="submit" class="text-blue-500 flex items-center pr-4">
        <span>Restore</span>
      </button>
    </form>
  @else
    @if ($canEdit)
      <a class="flex items-center text-green-500" href="{{$row->get('actions')['edit']}}">
        <x-heroicon-s-pencil class="w-4 h-4 mr-2" />
        Edit
      </a>
    @endif

    @if ($canDelete)
      <x-modal method="post" :action="$row->get('actions')['delete']" :withHeader="false" :withFooter="false">
        @csrf
        @method('delete')
      
        <div class="text-center p-5 flex-auto justify-center">
          <x-heroicon-s-trash class="w-16 h-16 mx-auto text-red-500" />
          <div class="text-xl font-bold py-4 ">Hapus Item</div>
          <p class="text-sm text-gray-500 px-8">
            Apakah anda yakin ingin menghapus item ini?
          </p>
          <p class="text-sm text-gray-500 px-8 mt-1.5">
            Proses ini tidak dapat dibatalkan.
          </p>
        </div>
      
        <div class="p-3 text-center space-x-2 md:block">
          <div @click="open = false" class="inline-block cursor-pointer mb-2 md:mb-0 bg-white px-5 py-2 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded-full hover:bg-gray-100 transition">
            Cancel
          </div>
          <button class="mb-2 md:mb-0 bg-red-500 border border-red-500 px-5 py-2 text-sm shadow-sm font-medium tracking-wider text-white rounded-full hover:bg-red-600 transition">
            Delete
          </button>
        </div>

        <x-slot name="openButton">
          <div class="text-red-500 flex items-center cursor-pointer">
            <x-heroicon-s-trash class="w-4 h-4 mr-2" />
            <span>Delete</span>
          </div>
        </x-slot>
      </x-modal>
    @endif

    @if ($canView)
      <a class="flex items-center text-blue-500" href="{{$row->get('actions')['view']}}" target="_blank">
        <x-heroicon-s-external-link class="w-4 h-4 mr-2" />
        View
      </a>
    @endif
  @endif
</div>
