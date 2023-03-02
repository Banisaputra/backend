@php
  $isEditing = !empty($post);
@endphp
<!DOCTYPE HTML>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="robots" content="noindex, nofollow" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $isEditing ? 'Edit "'.$post->title.'"' : 'Add New '.ucwords($type) }} - {{ get_cache('site_name') }}</title>
    <meta name="msapplication-TileImage" content="{{ get_cache('favicon')}}" />
    <link rel="icon" href="{{ get_cache('favicon')}}" sizes="32x32" />
    <link rel="apple-touch-icon" href="{{ get_cache('favicon')}}" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap">
    <link rel="stylesheet" href="https://unpkg.com/@tailwindcss/typography@0.1.2/dist/typography.min.css">

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/alpine.js') }}" defer></script>

    <style>
      [contenteditable="true"] {
        cursor: text;
      }

      [contenteditable="true"]:empty:before {
        content: attr(placeholder);
        color: rgb(179, 179, 179);
        outline: none;
      }
      
      [contenteditable="true"]:focus {
        outline: none;
      }

      .ce-block__content, 
      .ce-toolbar__content {
        max-width: 1000px;
      }
    </style>
  </head>
  <body>
    <div x-data="post()">
      {{-- Header --}}
      <div class="border-b border-gray-200 bg-white fixed top-0 left-0 right-0 z-40">
        <div class="container mx-auto py-2.5 px-5">
          <div class="flex items-center justify-between">
            {{-- Left Content --}}
            <x-button
              as="link"
              href="{{$backUrl}}"
              size="sm"
              theme="outline"
              label="Back to {{ ucwords($type) }} lists"
            >
              <x-slot name="leftIcon">
                <x-heroicon-o-arrow-narrow-left class="w-5 h-5 mr-3 text-gray-500" />
              </x-slot>
            </x-button>

            {{-- Right Content --}}
            <div class="flex items-center text-sm space-x-8">
              <template x-if="state === 'editing'">
                <div x-text="saveDraftText" class="cursor-pointer text-blue-600" @click="save('draft')"></div>
              </template>
              <template x-if="state === 'editing'">
                <a target="_blank" x-bind:href="previewUrl" class="flex items-center text-blue-600">
                  <span>Preview</span>
                  <x-heroicon-s-external-link class="w-5 h-5 ml-3" />
                </a>
              </template>

              <x-button
                x-text="saveButtonText"
                x-bind:disabled="!data.title || state === 'loading'"
                @click="save()"
                size="sm"
              />
            </div>
          </div>
        </div>
      </div>

      <div class="container mx-auto px-5 py-12 mt-16">
        <div class="grid grid-cols-8 px-10 2xl:px-0">
          <div class="col-span-6">
            <div
              id="post-title"
              contenteditable="true"
              class="pt-4 pb-8 text-4xl font-bold leading-normal text-gray-900 max-w-[1000px] mx-auto"
              placeholder="Judul postingan"
              @input="data.title = $event.target.textContent"
              @keydown.enter="$event.preventDefault()"
              @paste.prevent="onPasteTitle, data.title = $event.target.textContent">{{ $isEditing ? $post->title : null }}</div>

            <div class="content-block text-gray-600 !max-w-none">
              <div id="editorjs"></div>
            </div>
          </div>

          <div class="col-span-2">
            <div class="text-gray-400 text-sm bg-gray-50/50 rounded-lg p-6">
              <div class="mb-6 font-medium text-gray-600">Post Meta</div>
              <div class="space-y-6">
                <div class="flex items-center">
                  <x-heroicon-o-calendar class="w-4 h-4 mr-2.5" />
                  <span>
                    {{ $isEditing
                      ? \Carbon\Carbon::parse($post->created_at)->translatedFormat(get_cache('date_time_format'))
                      : date('d F Y')
                    }}
                  </span>
                </div>
                <div class="flex items-center ">
                  <x-heroicon-o-user class="w-4 h-4 mr-2.5" />
                  <span>{{ $isEditing ? $post->author->display_name : Auth()->user()->display_name }}</span>
                </div>
                @if ($isEditing)
                  <div class="flex items-center">
                    <x-heroicon-o-eye class="w-4 h-4 mr-2.5" />
                    <span>
                      {{ views($post)->count() }}
                    </span>
                  </div>
                @endif
              </div>

              @if ($type === 'article' && !$categories->isEmpty())
                <div class="mt-10 mb-6 font-medium text-gray-600">Categories</div>
                <div class="flex flex-col space-y-4 text-gray-500">
                  @foreach ($categories as $category)
                    <x-checkbox :label="$category->name" x-model="categories" name="category" :value="$category->id" />
                  @endforeach
                </div>
              @endif

            </div>
          </div>
        </div>
      </div>
    </div>

    <x-notify />

    <script src="{{ asset('js/editor.js') }}"></script>
    <script src="{{ asset('js/admin.js') }}"></script>
    @routes
    @stack('script')
    <script>
      document.addEventListener('alpine:init', () => {
        Alpine.data('post', () => ({
          editor: null,
          data: @json($post ?? null),
          state: @json($isEditing ? 'editing' : 'new'),
          previewUrl: @json($isEditing ? route('post', ['slug' => $post->slug]) : null),
          categories: @json($isEditing ? $post->categories->pluck('id') : []),

          init() {
            this.data = this.data ?? {};
            this.editor = new EditorJS({
              data: {
                blocks: this.data.content,
              },
              tools: window.EditorTools || {},
            });
          },

          saveDraftText() {
            const labels = {
              draft: 'Save draft',
              published: 'Switch to draft',
            }

            return labels[this.data.status];
          },

          saveButtonText() {
            const labels = {
              draft: 'Publish',
              published: 'Save',
            }

            switch (this.state) {
              case 'new':
                return `Create ${@json(ucwords($type))}`;
                break;
              case 'loading':
                return 'Loading...';
                break;
              default:
                return labels[this.data.status];
                break;
            }
          },

          save(status = 'published') {
            const oldPostData = this.data;
            const isCreatingNewPost = this.state === 'new';
            this.state = 'loading';

            this.editor.save().then((content) => {
              Ajax({
                headers: {
                  'Content-Type': 'application/json',
                },
                endpoint: isCreatingNewPost ? route('posts.store') : route('posts.update', { post: this.data.id }),
                method: 'POST',
                payload: JSON.stringify({
                  _method: isCreatingNewPost ? 'post' : 'put',
                  status: isCreatingNewPost ? 'draft' : status,
                  title: this.data.title,
                  category_id: this.data.category_id,
                  content: content.blocks,
                  type: @json($type),
                  category: this.categories,
                }),
                onSuccess: (response) => {
                  if (isCreatingNewPost) {
                    document.title = `Edit "${response.title}" - ${@json(get_cache('site_name'))}`;
                    window.history.pushState({}, '', `/dashboard/articles/${response.slug}/edit`);
                    notify({ type: 'success', message: `Berhasil membuat artikel` });
                  } else {
                    const message = {
                      draft: `${response.title} berhasil dipindah ke draft`,
                      published: `${response.title} berhasil dipublikasikan!`,
                    }

                    notify({ type: 'success', message: oldPostData.status === response.status ? 'Tersimpan' : message[response.status] });
                  }

                  this.data = response;
                  this.state = 'editing';
                  this.previewUrl = route('post', { slug: response.slug });
                },
                onError: () => {
                  this.state = isCreatingNewPost ? 'new' : 'editing';
                  notify({ type: 'error', message: 'Terjadi kesalahan dalam memproses permintaan.' });
                },
              })
            });
          },

          onPasteTitle(ev) {
            if (ev.clipboardData) {
              const content = ev.clipboardData.getData('text/plain');
              document.execCommand('insertText', false, content);
              return false;
            } else if (window.clipboardData) {
              const content = window.clipboardData.getData('Text');
              if (window.getSelection) {
                window.getSelection().getRangeAt(0).insertNode(document.createTextNode(content));
              }
            }
          },
        }));
      });
    </script>
  </body>
</html>
