@php
  $id = Str::random(10);
  $error = !empty($validationBagName) ? $errors->getBag($validationBagName) : $errors;
  $file = get_file($attributes['value']);
@endphp
<div>
  @if ($label)
    <div class="block text-gray-700 text-sm font-normal mb-2">
      {{$label}}

      @if ($attributes['required'])
        <span class="text-red-500">*</span>
      @endif
    </div>
  @endif
  
  <div class="relative border border-gray-200 bg-white p-4 rounded-lg" x-data="{
    existingValue: @json($file['exist']),
    file: null,
    resetFile() {
      this.$refs.input.value = null;
      this.file = null;
    },
    isImageFileType() {
      return this.file.type.includes('image');
    },
    bytesToHumanSize(bytes) {
      const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
      if (bytes == 0) return '0 Byte';
      const i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
      return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
    }}">

    @if ($error->first($name))
      <x-alert class="mb-6" :label="$error->first($name)" />
    @endif

    <div class="flex flex-col">
      <label for="file-input-{{$id}}" class="mb-4 flex flex-col items-center justify-center w-full border border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100">
        <div class="flex flex-col items-center justify-center py-16">
          <x-heroicon-o-cloud-upload class="w-10 h-10 mb-3 text-gray-400" />
          <p class="text-sm text-gray-500 dark:text-gray-400">
            <span class="font-semibold">Click to upload</span>
          </p>
          @if ($helperText)
            <p class="text-xs text-gray-500 dark:text-gray-400 mt-2">
              {{ $helperText }}
            </p>
          @endif
        </div>
      </label>

      <input
        {{ $attributes->merge() }}
        @change="file = Object.values($event.target.files)[0]"
        x-ref="input"
        id="file-input-{{$id}}"
        name="{{$name}}"
        type="file"
        class="hidden"
      />

      @if ($file['exist'])
        <template x-if="!file">
          <div class="flex bg-white border border-gray-200/75 py-4 px-5 rounded-lg">
            <img class="w-24 h-24 rounded-lg mr-5 object-cover object-center" src="{{$file['path']}}" alt="">
            <div class="text-sm max-w-[250px]">
              <div class="font-medium break-words text-gray-800">{{ basename($file['name']) }}</div>
              <div class="text-gray-400 mt-1.5" x-text="bytesToHumanSize(@json($file['size']))"></div>
            </div>
          </div>
        </template>
      @endif

      <template x-if="!file && !existingValue">
        <div class="text-center flex flex-col items-center justify-center my-4">
          <x-heroicon-o-folder-remove class="w-12 h-12 mb-4 text-gray-300" />
          <span class="text-sm text-gray-500">No file selected</span>
        </div>
      </template>

      <template x-if="file">
        <div class="flex justify-between items-center bg-white border border-gray-200/75 py-3 px-5 rounded-lg">
          <div class="flex">
            <template x-if="isImageFileType()">
              <img class="w-24 h-24 rounded-lg mr-5 object-cover object-center" :src="URL.createObjectURL(file)" alt="">
            </template>
            <template x-if="!isImageFileType()">
              <x-heroicon-o-document-add class="w-24 h-24 mr-5 text-gray-300" />
            </template>
            <div class="text-sm">
              <div class="font-medium text-gray-800" x-text="file.name"></div>
              <div class="text-gray-400 mt-1" x-text="bytesToHumanSize(file.size)"></div>
            </div>
          </div>
          <x-heroicon-s-trash @click="resetFile" class="w-6 h-6 text-red-500 hover:text-red-400 transition cursor-pointer" />
        </div>
      </template>
    </div>
  </div>
</div>
