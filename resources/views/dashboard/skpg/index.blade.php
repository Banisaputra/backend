@extends('layouts.admin')

@section('title', 'SKPG')

@section('title_with_action')
<span class="text-3xl font-bold text-teal-700">SKPG</span>
@endsection

@section('content')
<div>
  <form class="max-w-xl" action="{{route('skpg.store')}}" method="post" enctype="multipart/form-data">
    @csrf
  
    <x-file-input
      name="file"
      accept=".xlsx, .xls"
    />
  
    <x-button class="mt-5" label="Upload Data">
      <x-slot name="leftIcon">
        <x-heroicon-o-cloud-upload class="w-4 h-4 mr-2" />
      </x-slot>
    </x-button>
  </form>

  <hr class="my-10">

  @foreach ($group as $title => $type)
    <table class="w-full table-fixed rounded-md overflow-hidden mb-8">
      <tbody>
        <tr class="focus:outline-none border border-green-500 bg-green-500/10">
          <td class="border py-4 px-8 text-green-500 font-medium" colspan="2">{{ $title }}</td>
        </tr>
        @foreach ($type as $item)
          <tr class="focus:outline-none h-16 border border-gray-100 odd:bg-white even:bg-gray-50">
            <td class="border py-3 px-8">{{ $item->key }}</td>
            <td class="border py-3 px-8">
              <a class="font-medium text-red-400 hover:text-green-500 transition duration-200" href="{{route('skpg.show', ['title' => $item->title, 'key' => $item->key])}}">
                Lihat Chart
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  @endforeach
</div>
@endsection
