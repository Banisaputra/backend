@extends('layouts.default')

@section('title', 'Kelompok Wanita Tani')

@section('content')
<div class="container px-4 py-24 mx-auto">
  <div>
    <div class="border-l-4 border-green-500 pl-3 mb-5 text-gray-800 font-medium">
      Kelompok Wanita Tani
    </div>
    @if (request()->input('q'))
      <p class="italic text-sm text-gray-600">
        Menampilkan data dengan kata kunci: <u><i>{{ request()->input('q') }}</i></u>
      </p>
    @endif
    @if (!$data->isEmpty())
      <div class="flex items-center mt-16">
        <div class="bg-red-100 p-3.5 rounded-lg mr-4"></div>
        <div class="text-sm font-medium text-gray-500">Sudah menerima bantuan</div>
      </div>

      <table class="!pt-6 !mb-4 mt-8 whitespace-nowrap items-center w-full border-collapse">
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
            <th class="px-6 text-center align-middle border border-solid py-3 text-sm capitalize border-l-0 border-r-0 whitespace-nowrap font-semibold">
              Keterangan
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
            <td class="border-t-0 !py-4 px-6 align-middle border-l-0 border-r-0 text-sm text-center whitespace-nowrap">
              {{ $row->note ?: '-' }}
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    @else
      <div class="bg-gray-50/50 rounded-lg p-24 flex items-center justify-center mt-10">
        Data tidak ditemukan.
      </div>
    @endif
  </div>
</div>
@endsection
