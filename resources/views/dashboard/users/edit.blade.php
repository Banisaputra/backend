@extends('layouts.admin')

@section('title', 'Edit "'.$user->display_name.'"')

@section('title_with_action')
<span class="text-3xl font-bold text-teal-700">Edit Pengguna "{{ $user->display_name }}"</span>
@endsection

@section('content')
<form action="{{route('users.update', ['user' => $user->id])}}" method="post" class="bg-gray-50 p-10 rounded-lg">
  @method('put')
  @csrf

  <div class="space-y-5 max-w-lg">
    <x-text-input :value="$user->raw_display_name" name="display_name" type="text" placeholder="DKP Boyolali" label="Display Name" />
    <x-text-input disabled :value="$user->username" helperText="Your username must be 15 characters or less and contain only letters, numbers, and underscores and no spaces." name="username" type="text" placeholder="dkpboyolali" label="Username" />
    <x-text-input :value="$user->email" name="email" type="email" placeholder="dkp@boyolali.go.id" label="Email Address" />
    <div>
      <div class="border-t border-gray-200 my-6"></div>
    </div>
    <x-text-input name="password" type="password" placeholder="********" label="Password" />
    <x-text-input name="password_confirmation" type="password" placeholder="********" label="Retype Password" />
    @if (get_cache('master_account') != $user->id)
      <x-select name="role" label="Role" :options="$roles" />
    @endif
  </div>

  <div class="mt-10 flex items-center">
    <x-button as="link" href="{{route('users.index')}}" class="mr-3.5" label="Kembali" theme="outline" />
    <x-button label="Simpan" />
  </div>
</form>
@endsection
