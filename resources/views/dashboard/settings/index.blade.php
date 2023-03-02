@extends('layouts.admin')

@section('title', 'Pengaturan')
@section('title_with_action')
<span class="text-3xl font-bold text-teal-700">Pengaturan</span>
@endsection

@section('content')
<x-tabs
  :items="[
    [
      'label' => 'General',
      'template_location' => 'dashboard.settings.tab-content.general',
      'selected' => Session::get('active_tab') === 'general',
      'permission' => 'settings-update',
    ],
    [
      'label' => 'Menus',
      'template_location' => 'dashboard.settings.tab-content.menus',
      'selected' => Session::get('active_tab') === 'menus',
      'permission' => 'menus-read',
      'props' => [
        'menus' => $menus,
      ],
    ],
    [
      'label' => 'Categories',
      'template_location' => 'dashboard.categories.lists',
      'selected' => Session::get('active_tab') === 'categories' || $errors->categoryStoreForm->any(),
      'permission' => 'categories-read',
      'props' => [
        'categories' => $categories,
      ],
    ],
    [
      'label' => 'Account',
      'template_location' => 'dashboard.settings.tab-content.account',
      'selected' => Session::get('active_tab') === 'account',
    ],
    [
      'label' => 'RBAC',
      'template_location' => 'dashboard.settings.tab-content.rbac',
      'selected' => Session::get('active_tab') === 'rbac',
      'role' => 'administrator',
      'props' => [
        'roles' => $roles,
        'permissions' => $permissions,
      ],
    ]
  ]"
/>
@endsection

@push('script')
<script src="{{ asset('js/sortable.js') }}"></script>
<script>
  document.addEventListener('alpine:init', () => {
    Alpine.data('menus', () => ({
      menus: @json($menus->map->only(['label', 'object_type', 'object_value'])),
      dirty: false,
      selectedPages: [],
      customLink: {},

      init() {
        Sortable.create(this.$refs.sortable, {
          handle: '.menu-header',
          animation: 250,
          ghostClass: '!bg-gray-200',
          onEnd: (event) => {
            const menus = Alpine.raw(this.menus);
            const movedStep = menus.splice(event.oldIndex, 1)[0];

            menus.splice(event.newIndex, 0, movedStep);
              
            this.menus = menus;
            this.dirty = true;
          }
        });

        this.$watch('menus', () => {
          this.dirty = true;
        });
      },

      selectPage(page) {
        return function (event) {
          if (event.target.checked && !this.checkIfPageIsSelected(page.id)) {
            this.selectedPages.push(page);
          } else {
            this.selectedPages = this.selectedPages.filter((selectedPage) => page.id !== selectedPage.id);
          }
        }
      },

      checkIfPageIsSelected(id) {
        return this.selectedPages.some((page) => page.id === id);
      },

      addPageToMenu() {
        const pagesMenu = this.selectedPages.map((page) => ({
          label: page.title,
          object_type: 'page',
          object_value: page.id,
        }));

        this.selectedPages = [];
        this.menus = [
          ...this.menus,
          ...pagesMenu,
        ];

        // reset pages checkbox
        document.querySelectorAll('input[name="page"]')
          .forEach((checkbox) => checkbox.checked = false);
      },

      addCustomLinkToMenu() {
        this.menus.push({
          ...this.customLink,
          object_type: 'custom_link',
        });

        this.customLink = {};
      },

      removeMenu(index) {
        this.menus.splice(index, 1);
      }
    }));
  });
</script>
@endpush