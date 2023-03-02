@extends('layouts.admin')

@section('title', 'Edit Role "'.$role->display_name.'"')

@section('title_with_action')
<span class="text-3xl font-bold text-teal-700">Edit Role "{{ $role->display_name }}"</span>
@endsection

@section('content')
<form action="{{route('rbac.update', ['rbac' => $role->id])}}" method="post" class="bg-gray-50 p-10 rounded-lg">
  @method('put')
  @csrf

  <div class="space-y-5 max-w-lg">
    <x-text-input :value="old('display_name') ?? $role->display_name" required label="Nama" name="display_name" type="text" />
    <x-text-area :value="old('description') ?? $role->description" rows="3" label="Deskripsi" name="description" type="text" />
  </div>

  <div class="mt-10 flex items-center">
    <x-button as="link" href="{{route('settings.index')}}" class="mr-3.5" label="Kembali" theme="outline" />
    <x-button label="Simpan" />
  </div>
</form>
@endsection
