@extends('layouts.admin')

@section('title', 'Pengguna')

@section('title_with_action')
<span class="text-3xl font-bold text-teal-700">Pengguna</span>
{{-- Create User Modal --}}
@permission('users-create')
  <x-modal :isOpen="$errors->userStoreForm->any()" method="post" action="{{ route('users.store') }}" title="Buat Akun Pengguna">
    @csrf

    <div class="space-y-5">
      <x-text-input validationBagName="userStoreForm" helperText="Username must be 15 characters or less and contain only letters, numbers, and underscores and no spaces." name="username" required type="text" placeholder="dkpboyolali" label="Username" />
      <x-text-input validationBagName="userStoreForm" name="email" required type="email" placeholder="dkp@boyolali.go.id" label="Email Address" />
      <x-text-input validationBagName="userStoreForm" name="password" required type="password" placeholder="********" label="Password" />
      <x-text-input validationBagName="userStoreForm" required name="password_confirmation" type="password" placeholder="********" label="Retype Password" />
      <x-select validationBagName="userStoreForm" name="role" label="Role" :options="$roles" />
    </div>

    <x-slot name="submit_button">
      <x-button label="Buat Akun">
        <x-slot name="leftIcon">
          <x-heroicon-s-plus-circle class="w-4 h-4 mr-2.5" />
        </x-slot>
      </x-button>
    </x-slot>

    <x-slot name="openButton">
      <x-button label="Buat Akun" theme="outline" size="sm">
        <x-slot name="leftIcon">
          <x-heroicon-s-plus class="w-5 h-5 mr-2" />
        </x-slot>
      </x-button>
    </x-slot>
  </x-modal>
@endpermission
@endsection

@section('content')
@php
  $canEdit = Auth()->user()->isAbleTo('users-update');
  $canDelete = Auth()->user()->isAbleTo('users-delete');
@endphp
<x-admin.data-viewer searchByKey="username" :withFilter="false" :withBulkAction="false">
  <x-admin.data-table
    :withCheckboxes="false"
    :withActions="$canEdit || $canDelete"
    :columns="[
      [
        'label' => 'Username',
        'field' => 'username',
        'sort' => true,
      ],
      [
        'label' => 'Name',
        'field' => 'display_name',
        'classes' => 'xl:hidden',
        'sort' => true,
      ],
      [
        'label' => 'Email',
        'field' => 'email',
        'sort' => true,
      ],
      [
        'label' => 'Role',
        'field' => 'role',
      ],
    ]"
    :rows="$users->getCollection()->map(function ($user) use ($canEdit, $canDelete) {
      return collect([
        'collection' => $user,
        'actions' => [
          'delete' => $canDelete ? route('users.destroy', ['user' => $user->id]) : null,
          'edit' => $canEdit ? route('users.edit', ['user' => $user->id]) : null,
        ],
        'username' => [
          'value' => $user->username,
          'primary_label' => true,
        ],
        'display_name' => [
          'value' => $user->display_name,
          'classes' => 'xl:hidden',
        ],
        'email' => [
          'value' => $user->email,
        ],
        'role' => [
          'value' => $user->roles->first()->display_name,
        ]
      ]);
    })"
  />

  {{ $users->links('components.pagination') }}
</x-admin.data-viewer>
@endsection
