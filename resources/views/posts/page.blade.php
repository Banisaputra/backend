<div class="container px-6 pt-16 pb-24 mx-auto">
  @permission('pages-update')
    <div class="bg-gray-50 p-4 rounded-lg mb-6 border border-gray-200">
      <a class="flex items-center" href="{{route('pages.edit', ['page' => $post->slug])}}">
        <x-heroicon-s-pencil class="w-4 h-4 text-blue-500" />
        <span class="ml-4 text-blue-500 text-sm font-medium">Edit This Page</span>
      </a>
    </div>
  @endpermission

  <h1 class="text-2xl lg:text-3xl font-semibold mb-16 text-center !leading-normal">
    {{ $post->title }}
  </h1>
  <div class="mt-5 prose prose-slate mx-auto !max-w-5xl">
    @if ($post->content && is_array($post->content))
      @foreach ($post->content as $block)
        <x-dynamic-component :component="'post.block.'.$block->type" :content="$block" />
      @endforeach
    @endif
  </div>
</div>