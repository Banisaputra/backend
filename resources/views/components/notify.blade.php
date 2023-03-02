<div id="notify-wrapper" @add="add" x-cloak x-data="{
  isShow: false,
  data: {{ json_encode(Session::get('notify')) }},
  styles: {
    success: 'bg-green-500 text-white border-white',
    error: 'bg-white text-gray-700 border-red-500',
  },
  add(event) {
    this.data = event.detail;
  },
  init() {
    setTimeout(() => {
      this.isShow = true;
    }, 150);
  
    setTimeout(() => {
      this.isShow = false;
    }, 3500);

    this.$watch('data', () => {
      this.isShow = true;
  
      setTimeout(() => {
        this.isShow = false;
      }, 3500);
    });
  }
}">
  <template x-if="data?.message">
    <div
      x-show="isShow"
      x-transition:enter="transition ease-out duration-200"
      x-transition:enter-start="transform scale-75 translate-x-10 opacity-0"
      x-transition:enter-end="transform scale-100 translate-x-0 opacity-100"
      class="fixed bottom-0 right-0 m-10 py-3 px-5 flex items-center border-t-4 max-w-xs rounded-lg shadow z-50"
      :class="styles[data?.type]"
     >
      <template x-if="data?.type === 'success'">
        <div class="rounded-full p-2 mr-4 bg-white text-green-500">
          <x-heroicon-s-check-circle class="w-4 h-4"/>
        </div>
      </template>

      <template x-if="data?.type === 'error'">
        <div class="rounded-full p-2 mr-4 bg-red-500 text-white">
          <x-heroicon-s-check-circle class="w-4 h-4"/>
        </div>
      </template>

      <div x-text="data?.message">
      </div>
    </div>
  </template>
</div>
