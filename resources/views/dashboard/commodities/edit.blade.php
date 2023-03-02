@extends('layouts.admin')

@section('title', 'Edit "'.$commodity->name.'"')

@section('title_with_action')
<span class="text-3xl font-bold text-teal-700">Edit Komoditas "{{ $commodity->name }}"</span>
@endsection

@section('content')
<form action="{{route('commodities.update', ['commodity' => $commodity->id])}}" method="post" class="bg-gray-50 p-10 rounded-lg" enctype="multipart/form-data">
  @method('put')
  @csrf

  <div class="max-w-xl space-y-5">
    <x-text-input
      label="Nama"
      name="name"
      type="text"
      required
      placeholder="Beras Premium"
      :value="old('name') ?? $commodity->name"
    />
    <x-text-input
      label="Unit"
      name="unit"
      type="text"
      placeholder="Kg"
      :value="old('unit') ?? $commodity->unit"
    />
    <x-text-input
      required
      label="Harga"
      name="price"
      type="text"
      placeholder="25.000"
      x-mask:dynamic="$money($input, ',')"
      :value="old('price') ?? $commodity->lastPrice->price"
    />
    <x-file-input
      label="Gambar"
      name="image"
      type="file"
      accept="image/*"
      :value="$commodity->image"
    />
  </div>

  <div class="mt-10 flex items-center">
    <x-button as="link" href="{{route('commodities.index')}}" class="mr-3.5" label="Kembali" theme="outline" />
    <x-button label="Simpan" />
  </div>
</form>
@endsection

@push('script:alpine.plugins')
<script defer src="https://unpkg.com/@alpinejs/mask@3.10.2/dist/cdn.min.js"></script>
@endpush

