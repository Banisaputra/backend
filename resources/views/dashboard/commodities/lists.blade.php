@extends('layouts.admin')

@section('title_with_action')
<span class="text-3xl font-bold text-teal-700">Komoditas</span>
@permission('commodities-create')
  <x-modal :isOpen="$errors->commodityStoreForm->any()" method="post" :action="route('commodities.store')" enctype="multipart/form-data" title="Tambah Komoditas Baru">
    @csrf

    <div class="space-y-5">
      <x-text-input validationBagName="commodityStoreForm" required placeholder="Beras Premium" label="Nama" name="name" type="text" />
      <x-text-input validationBagName="commodityStoreForm" placeholder="Kg" label="Unit" name="unit" type="text" />
      <x-text-input validationBagName="commodityStoreForm" required x-mask:dynamic="$money($input, ',')" placeholder="25.000" label="Harga" name="price" type="text" />
      <x-file-input validationBagName="commodityStoreForm" required label="Gambar" name="image" accept="image/*" />
    </div>

    <x-slot name="submit_button">
      <x-button label="Tambah Komoditas">
        <x-slot name="leftIcon">
          <x-heroicon-s-plus-circle class="w-4 h-4 mr-2.5" />
        </x-slot>
      </x-button>
    </x-slot>

    <x-slot name="openButton">
      <x-button label="Tambah Komoditas" theme="outline" size="sm">
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
  $canDelete = Auth()->user()->isAbleTo('commodities-delete');
  $canEdit = Auth()->user()->isAbleTo('commodities-update');
@endphp
<div class="flex justify-end mb-5">
  <x-button size="sm" as="link" href="{{route('commodities.export')}}" label="Export Data (.xlsx)">
    <x-slot name="leftIcon">
      <x-heroicon-s-download class="w-4 h-4 mr-2.5" />
    </x-slot>
  </x-button>
</div>

<x-admin.data-viewer :withFilter="false" searchByKey="name">
  <x-admin.data-table
    :withActions="$canDelete || $canEdit"
    :withCheckboxes="false"
    :columns="[
      [
        'label' => 'Nama Komoditas',
        'field' => 'name',
        'sort' => true,
      ],
      [
        'label' => 'Harga Per Unit',
        'field' => 'price',
      ],
      [
        'label' => 'Terakhir Diperbarui',
        'field' => 'last_updated',
      ],
    ]"
    :rows="$commodities->map(function ($commodity) use ($canDelete, $canEdit) {
      return collect([
        'collection' => $commodity,
        'actions' => [
          'delete' => $canDelete ? route('commodities.destroy', ['commodity' => $commodity->id]) : null,
          'edit' => $canEdit ? route('commodities.edit', ['commodity' => $commodity->id]) : null,
        ],
        'name' => [
          'value' => $commodity->name,
          'primary_label' => true,
          'link' => route('commodities.show', ['commodity' => $commodity->id]),
        ],
        'price' => [
          'value' => format_currency($commodity->lastPrice->price),
        ],
        'last_updated' => [
          'value' => \Carbon\Carbon::parse($commodity->lastPrice->created_at)->translatedFormat(get_cache('date_time_format')),
        ],
      ]);
    })"
  />
</x-admin.data-viewer>
@endsection

@push('script:alpine.plugins')
<script defer src="https://unpkg.com/@alpinejs/mask@3.10.2/dist/cdn.min.js"></script>
@endpush
