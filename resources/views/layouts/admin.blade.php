<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="robots" content="noindex, nofollow" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'Dashboard') - {{ get_cache('site_name') }}</title>
    <meta name="msapplication-TileImage" content="{{ get_cache('favicon')}}" />
    <link rel="icon" href="{{ get_cache('favicon')}}" sizes="32x32" />
    <link rel="apple-touch-icon" href="{{ get_cache('favicon')}}" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap">

    @stack('script:alpine.plugins')
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/alpine.js') }}" defer></script>

    <style>
      @media only screen and (max-width: 1023px) {
        .hidden-on-mobile {
          display: none !important;
        }
      }
    </style>
    @stack('head')
  </head>
  <body class="bg-gray-100">
    <div class="min-h-screen flex">
      <div class="py-12 px-4 lg:px-6 xl:px-10 w-[80px] flex-shrink-0 lg:w-1/4 2xl:w-1/5">
        <div class="flex items-center justify-center border-b border-gray-300 pb-6 lg:justify-start">
          <a href="{{ route('home') }}">
            <img src="{{ get_cache('logo')}}" class="h-12" />
          </a>
          <div class="ml-5 hidden-on-mobile">
            <div class="font-bold text-teal-600">Dashboard</div>
            <a href="{{ route('home') }}" class="mt-0.5 text-sm font-medium text-gray-400">
              {{ get_cache('site_name_short', get_cache('site_name')) }}
            </a>
          </div>
        </div>
        <div class="mt-6 space-y-5">
          @foreach (config('admin-navigation-menu') as $menu)
            @role($menu['role'] ?? [])
              @permission($menu['permission'] ?? [])
                <x-admin.navigation-menu :menu="$menu" />
              @endpermission
            @endrole
          @endforeach
        </div>
        <a href="{{route('logout')}}" class="flex mt-20 ml-3 space-x-4 items-center text-red-500 hover:text-red-600 transition duration-200">
          <x-heroicon-o-logout class="w-6 h-6" />
          <div class="hidden-on-mobile">Logout</div>
        </a>
      </div>

      <div class="bg-white py-12 px-10 flex-1 lg:w-3/4 2xl:w-4/5">
        <div class="mb-12">
          <div class="text-sm font-medium text-gray-500 bg-gray-100 py-2 px-4 rounded-lg inline-block">
            Hi, {{Auth()->user()->display_name}} 👋
          </div>
          <div class="flex items-center space-x-4 mt-5">
            @yield('title_with_action')
          </div>
        </div>

        @yield('content')
      </div>
    </div>

    <x-notify />

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
    <script>
      window.addEventListener('alpine:init', () => {
        Alpine.data('posts', () => ({
          filters: {},
          selectedAll: false,
          checkboxes: [],
          selectedItems: [],
          bulkAction: null,
          sort: {},
          
          init() {
            this.checkboxes = document.querySelectorAll('[data-checkbox-row]');
            this.filters = qs.parse(location.search, { ignoreQueryPrefix: true });
            
            if (this.filters.sort) {
              this.sort = {
                by: this.filters.sort.replace('-', ''),
                position: this.filters.sort.startsWith('-') ? 'desc' : 'asc',
              };
            }

            this.$watch('selectedItems', () => {
              this.selectedAll = this.selectedItems.length === this.checkboxes.length;
            });
          },

          assignFilter(filter) {
            this.filters = assign(this.filters, filter);
          },

          mergeFilter(filter) {
            this.filters = merge(this.filters, filter);
          },

          sortData(field) {
            // reverse sorting
            const filter = this.sort?.by === field && this.sort?.position === 'asc' ? `-${field}` : field;

            this.filters = merge(this.filters, {
              sort: filter,
            });
          },

          applyFilter() {
            const currentQueryString = qs.parse(location.search, { ignoreQueryPrefix: true });
            const applyFilters = this.filters;
            // if new post status different from the old one, reset the pagination to page 1
            if (applyFilters?.filter?.status !== currentQueryString?.filter?.status) {
              applyFilters.page = 1;
            }

            window.location = window.location.origin + window.location.pathname + qs.stringify(applyFilters, {
              strictNullHandling: true,
              addQueryPrefix: true,
            });
          },

          selectAllCheckboxes() {
            this.selectedAll = !this.selectedAll;

            const allValues = [...this.checkboxes].map((checkbox) => checkbox.value);
            this.selectedItems = this.selectedAll ? allValues : [];
          },
        }));
      });
    </script>

    @stack('script')
  </body>
</html>
