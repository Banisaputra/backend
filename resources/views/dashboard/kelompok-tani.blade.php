@extends('layouts.admin')

@section('title', 'Data Kelompok Wanita Tani')
@section('title_with_action')
<span class="text-3xl font-bold text-teal-700">Data Kelompok Wanita Tani</span>
@endsection

@section('content')
<div class="container mx-auto">
  <form method="post" class="bg-gray-50 p-4 rounded-lg flex items-center justify-between mb-16" action="{{route('settings.update', ['setting' => 'show_kwt_search'])}}">
    @csrf
    @method('put')

    <x-checkbox-boolean name="show_kwt_search" label="Tampilkan untuk umum?" :checked="get_cache('show_kwt_search')" />
    <x-button size="sm" label="Simpan" />
  </form>

  <div class="mb-10">
    <div class="flex items-center space-x-3">
      <x-button size="sm" as="link" href="{{route('kelompok-tani.export')}}" label="Export Data (.xlsx)" theme="outline">
        <x-slot name="leftIcon">
          <x-heroicon-s-download class="w-4 h-4 mr-2.5" />
        </x-slot>
      </x-button>
      <x-button size="sm" label="Tambah Data" data-button-modal data-target="buat-data">
        <x-slot name="leftIcon">
          <x-heroicon-s-plus class="w-4 h-4 mr-2" />
        </x-slot>
      </x-button>
    </div>
  </div>

  <div id="spinner" class="flex items-center justify-center h-96 bg-gray-50 rounded-lg">
    <svg role="status" class="w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-green-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
      <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
      <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
    </svg>
    <div class="text-gray-500 ml-2.5">Tunggu sebentar...</div>
  </div>
  
  <table id="table-kelompok-tani" class="!pt-6 !mb-4 hidden w-full border-collapse">
    <thead>
      <tr>
        <th class="px-6 align-middle border border-solid py-3 text-sm capitalize border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
          Kecamatan
        </th>
        <th class="px-6 align-middle border border-solid py-3 text-sm capitalize border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
          Desa
        </th>
        <th class="px-6 align-middle border border-solid py-3 text-sm capitalize border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
          Nama Kelompok
        </th>
        <th class="px-6 align-middle border border-solid py-3 text-sm capitalize border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
          Nama Ketua
        </th>
        <th class="px-6 align-middle border border-solid py-3 text-sm capitalize border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
          Nomor Register
        </th>
        <th class="px-6 align-middle border border-solid py-3 text-sm capitalize border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
          Keterangan
        </th>
        <th class="px-6 align-middle border border-solid py-3 text-sm capitalize border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
        </th>
      </tr>
    </thead>
  
    <tbody>
      @foreach ($data as $row)
        <tr @class([
          'odd:bg-gray-50',
          '!bg-red-100' => $row->note,
        ])>
          <td class="border-t-0 !py-4 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap">
            {{ $row->district }}
          </td>
          <td class="border-t-0 !py-4 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap">
            {{ $row->subdistrict }}
          </td>
          <td class="border-t-0 !py-4 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap">
            {{ $row->group_name }}
          </td>
          <td class="border-t-0 !py-4 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap">
            {{ $row->leader }}
          </td>
          <td class="border-t-0 !py-4 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap">
            {{ $row->registration_number }}
          </td>
          <td class="border-t-0 !py-4 px-6 align-middle border-l-0 border-r-0 text-sm whitespace-nowrap">
            {{ $row->note }}
          </td>
          <td>
            <div class="flex items-center space-x-2.5">
              <x-button label="Edit" theme="outline" size="sm" data-target="edit-{{$row->id}}" data-button-modal class="!text-green-500 !border-green-500 hover:!bg-green-100">
                <x-slot name="leftIcon">
                  <x-heroicon-s-pencil class="w-4 h-4 mr-2.5 text-green-500" />
                </x-slot>
              </x-button>
              <form action="{{route('kelompok-tani.destroy', ['kelompok_tani' => $row->id])}}" method="post">
                @csrf
                @method('delete')
                <x-button label="Delete" theme="danger" size="sm">
                  <x-slot name="leftIcon">
                    <x-heroicon-s-trash class="w-4 h-4 mr-2.5" />
                  </x-slot>
                </x-button>
              </form>
            </div>
  
            <div modal-name="edit-{{$row->id}}" class="penghalang">
              <div class="fixed inset-0 z-10 bg-gray-700/75"></div>
              <div class="modal-content">
                <div class="py-12 transition duration-150 ease-in-out absolute top-0 right-0 bottom-0 left-0 z-50" id="modal">
                  <div role="alert" class="container mx-auto w-11/12 md:w-2/3 max-w-lg pb-8">
                    <form method="post" action="{{route('kelompok-tani.update', ['kelompok_tani' => $row->id])}}" class="relative py-8 px-5 md:px-10 bg-white shadow-md rounded border border-gray-400">
                      @csrf
                      @method('put')
  
                      <label for="name" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Nama Kecamatan</label>
                      <input value="{{$row->district}}" name="district" id="name" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-green-500 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="ketik nama Kecamatan" />
                      <label for="name" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Nama Desa</label>
                      <input value="{{$row->subdistrict}}" name="subdistrict" id="name" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-green-500 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="ketik nama Desa" />
                      <label for="name" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Nama Kelompok Wanita Tani</label>
                      <input value="{{$row->group_name}}" name="group_name" id="name" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-green-500 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="ketik nama Kelompok" />
                      <label for="name" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Nama Ketua Kelompok</label>
                      <input value="{{$row->leader}}" name="leader" id="name" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-green-500 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="Ketik nama Ketua Kelompok" />
                      <label for="name" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Nomor Register</label>
                      <input value="{{$row->registration_number}}" name="registration_number" id="name" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-green-500 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="Ketik Nomor Register" />
                      <label for="name" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Note</label>
                      <input value="{{$row->note}}" name="note" id="name" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-green-500 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="Keterangan" />
                      <div class="flex items-center justify-start w-full">
                        <input type="submit" value="Submit" name="buat_data" class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out hover:bg-green-400 bg-green-500 rounded text-white px-8 py-2 text-sm" />
                        <button class="focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-400 ml-3 bg-gray-100 transition duration-150 text-gray-600 ease-in-out hover:border-gray-400 hover:bg-gray-300 border rounded px-8 py-2 text-sm" data-close>Cancel</button>
                      </div>
                      <button class="cursor-pointer absolute top-0 right-0 mt-4 mr-5 text-gray-400 hover:text-gray-600 transition duration-150 ease-in-out rounded focus:ring-2 focus:outline-none focus:ring-gray-600" data-close aria-label="close modal" role="button">
                        <svg  xmlns="http://www.w3.org/2000/svg"  class="icon icon-tabler icon-tabler-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                          <path stroke="none" d="M0 0h24v24H0z" />
                          <line x1="18" y1="6" x2="6" y2="18" />
                          <line x1="6" y1="6" x2="18" y2="18" />
                        </svg>
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  
  <div modal-name="buat-data" class="penghalang">
    <div class="fixed inset-0 z-10 bg-gray-700/75"></div>
    <div class="modal-content">
      <div class="py-12 transition duration-150 ease-in-out absolute top-0 right-0 bottom-0 left-0 z-50" id="modal">
        <div role="alert" class="container mx-auto w-11/12 md:w-2/3 max-w-lg pb-8">
          <form method="post" action="{{route('kelompok-tani.store')}}" class="relative py-8 px-5 md:px-10 bg-white shadow-md rounded border border-gray-400">
            @csrf
            <label for="name" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Nama Kecamatan</label>
            <input required name="district" id="name" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-green-500 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="ketik nama Kecamatan" />
            <label for="name" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Nama Desa</label>
            <input required name="subdistrict" id="name" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-green-500 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="ketik nama Desa" />
            <label for="name" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Nama Kelompok Wanita Tani</label>
            <input required name="group_name" id="name" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-green-500 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="ketik nama Kelompok" />
            <label for="name" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Nama Ketua Kelompok</label>
            <input required name="leader" id="name" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-green-500 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="Ketik nama Ketua Kelompok" />
            <label for="name" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Nomor Register</label>
            <input required name="registration_number" id="name" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-green-500 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="Ketik Nomor Register" />
            <label for="name" class="text-gray-800 text-sm font-bold leading-tight tracking-normal">Note</label>
            <input name="note" id="name" class="mb-5 mt-2 text-gray-600 focus:outline-none focus:border focus:border-green-500 font-normal w-full h-10 flex items-center pl-3 text-sm border-gray-300 rounded border" placeholder="Keterangan" />
            <div class="flex items-center justify-start w-full">
              <input type="submit" value="Submit" name="buat_data" class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition duration-150 ease-in-out hover:bg-green-400 bg-green-500 rounded text-white px-8 py-2 text-sm" />
              <button class="focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-gray-400 ml-3 bg-gray-100 transition duration-150 text-gray-600 ease-in-out hover:border-gray-400 hover:bg-gray-300 border rounded px-8 py-2 text-sm" data-close>Cancel</button>
            </div>
            <button class="cursor-pointer absolute top-0 right-0 mt-4 mr-5 text-gray-400 hover:text-gray-600 transition duration-150 ease-in-out rounded focus:ring-2 focus:outline-none focus:ring-gray-600" data-close aria-label="close modal" role="button">
              <svg  xmlns="http://www.w3.org/2000/svg"  class="icon icon-tabler icon-tabler-x" width="20" height="20" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" />
                <line x1="18" y1="6" x2="6" y2="18" />
                <line x1="6" y1="6" x2="18" y2="18" />
              </svg>
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('head')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.12.1/r-2.3.0/datatables.min.css"/>
<style type="text/css">
  .penghalang {
    display: none;
    position: fixed;
    z-index: 1;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgb(0,0,0);
    background-color: rgba(0,0,0,0.4);
  }

  .modal-content {
    margin: 15% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 80%;
  }

  #tutup {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
  }

  #tutup:hover,
  #tutup:focus {
    color: black;
    cursor: pointer;
  }
</style>
@endpush

@push('script')
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-3.6.0/dt-1.12.1/r-2.3.0/datatables.min.js"></script>
<script>
  const table = document.querySelector('#table-kelompok-tani');
  const spinner = document.querySelector('#spinner');

  document.addEventListener('DOMContentLoaded', function () {
    new DataTable(table, {
      lengthMenu: [20, 50, 100, 200], 
      fnInitComplete: function() {
        table.classList.remove('hidden');
        spinner.classList.add('hidden');
      }
    });
  });
  
  const buttons = document.querySelectorAll('[data-button-modal]');

  buttons.forEach((btn) => {
    const targetModal = btn.getAttribute('data-target');
    const modal = document.querySelector(`[modal-name="${targetModal}"]`);
    const closeButtons = modal.querySelectorAll('[data-close]');
    
    closeButtons.forEach((closeBtn) => {
      closeBtn.addEventListener('click', (ev) => {
        ev.preventDefault();
        modal.style.display = 'none';
      });
    });

    btn.onclick = function() {
      modal.style.display = 'block';
    }
  });
</script>
@endpush
