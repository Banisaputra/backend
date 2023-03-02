<div class="container px-6 pt-12 pb-24 mx-auto">
  <div class="md:grid md:grid-cols-12 md:gap-12">
    <div class="md:col-span-8 2xl:col-span-7 2xl:col-start-2">
      @permission('articles-update')
        <div class="bg-gray-50 p-4 rounded-lg mb-6 border border-gray-200">
          <a class="flex items-center" href="{{route('articles.edit', ['article' => $post->slug])}}">
            <x-heroicon-s-pencil class="w-4 h-4 text-blue-500" />
            <span class="ml-4 text-blue-500 text-sm font-medium">Edit This Post</span>
          </a>
        </div>
      @endpermission
      
      <div class="flex items-center space-x-4 mb-5">
        <a class="text-green-500" href="{{route('home')}}">Home</a>
        <div class="text-gray-400 text-sm">/</div>
        <a class="text-green-500" href="{{route('blog')}}">Blog</a>
        <div class="text-gray-400 text-sm">/</div>
        <div class="text-gray-600">
          {{ Str::limit(ucwords(strtolower($post->title)), 50) }}
        </div>
      </div>

      <h1 class="text-2xl lg:text-3xl font-semibold !leading-normal">
        {{ $post->title }}
      </h1>
      <div class="mt-5 mb-8 space-y-6 md:space-y-0 md:flex md:items-center md:space-x-6 text-gray-400 text-sm">
        <div class="flex items-center ">
          <x-heroicon-o-calendar class="w-4 h-4 mr-2.5" />
          <span>
            {{ \Carbon\Carbon::parse($post->created_at)->translatedFormat(get_cache('date_time_format')) }}
          </span>
        </div>
        <div class="flex items-center ">
          <x-heroicon-o-user class="w-4 h-4 mr-2.5" />
          <span>{{ $post->author->display_name }}</span>
        </div>
        <div class="flex items-center ">
          <x-heroicon-o-folder class="w-4 h-4 mr-2.5" />
          @foreach ($post->categories as $category)
            <a href="{{route('category', ['slug' => $category->slug])}}" class="hover:text-green-500 duration-200">
              {{ $category->name }}
            </a>

            @if (!$loop->last)
              <span class="mr-1">,</span>
            @endif
          @endforeach
        </div>
      </div>
      <div class="prose prose-slate mx-auto !text-gray-800 !max-w-none">
        @if ($post->content && is_array($post->content))
          @foreach ($post->content as $block)
            <x-dynamic-component :component="'post.block.'.$block->type" :content="$block" />
          @endforeach
        @endif
      </div>
    </div>

    <div class="md:col-span-4 2xl:col-span-3">
      <div class="flex items-center font-medium mt-10 md:mt-0 bg-green-500 text-white rounded-lg py-3 px-5">
        <div class="w-1.5 h-1.5 rounded-full bg-white mr-3"></div>
        <div>Artikel Lainnya</div>
      </div>

      <div class="mt-5 space-y-3.5">
        @foreach ($recentPosts as $post)
          <div class="rounded-xl border border-gray-200 p-4">
            <div class="flex flex-col justify-between leading-normal">
              <div>
                <div class="text-black flex items-center ">
                  <a class="text-sm font-semibold leading-6 mx-0 my-2 lg:my-0 relative hover:text-green-500 transition" href="{{ route('post', ['slug' => $post->slug]) }}">
                    {{ ucwords(strtolower($post->title)) }}
                  </a>
                </div>
                <div class="flex items-center space-x-3 md:mt-1.5">
                  <div class="text-gray-400 text-xs flex items-center">
                    <x-heroicon-o-calendar class="w-3 h-3 mr-1.5" />
                    <span>{{ \Carbon\Carbon::parse($post->created_at)->translatedFormat(get_cache('date_time_format')) }}</span>
                  </div>
                  <div class="text-gray-400 text-xs flex items-center">
                    <x-heroicon-o-user class="w-3 h-3 mr-1.5" />
                    <span>{{ $post->author->display_name }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
