@if ($paginator->hasPages())
<div class="flex items-center justify-between my-8">
  <div class="text-sm text-gray-600 italic">
    Results: {{ $paginator->firstItem() }} - {{ $paginator->lastItem() }} of {{ $paginator->total() }}
  </div>
  <div class="flex space-x-2 text-gray-700">
    <div class="flex items-center">
      @php
        $start = $paginator->currentPage() - 2; // show 3 pagination links before current
        $end = $paginator->currentPage() + 2; // show 3 pagination links after current
        if ($start < 1) {
          $start = 1; // reset start to 1
          $end += 1;
        }

        if ($end >= $paginator->lastPage()) {
          $end = $paginator->lastPage(); // reset end to last page
        }
      @endphp

      @if($start > 1)
        <a class="w-12 h-12 md:flex justify-center items-center hidden cursor-pointer leading-5 transition duration-150 rounded-md ease-in border-t-2" href="{{ $paginator->url(1) }}">
          1
        </a>
        @if($paginator->currentPage() != 4)
          {{-- "Three Dots" Separator --}}
          <div class="w-12 h-12 flex justify-center items-center" aria-disabled="true">
            <span>...</span>
          </div>
        @endif
      @endif

      @for ($i = $start; $i <= $end; $i++)
        <a href="{{ $paginator->url($i) }}" @class([
          'w-12 h-12 md:flex justify-center items-center hidden cursor-pointer leading-5 transition duration-150 rounded-md ease-in border-t-2 mx-1',
          'bg-gray-100 border-green-500 text-green-500' => $paginator->currentPage() == $i,
        ])>
          {{$i}}
        </a>
      @endfor

      @if($end < $paginator->lastPage())
        @if($paginator->currentPage() + 3 != $paginator->lastPage())
          {{-- "Three Dots" Separator --}}
          <div class="w-12 h-12 flex justify-center items-center" aria-disabled="true">
            <span>...</span>
          </div>
        @endif
        <a class="w-12 h-12 md:flex justify-center items-center hidden cursor-pointer leading-5 transition duration-150 rounded-md ease-in border-t-2" href="{{ $paginator->url($paginator->lastPage()) }}">
          {{$paginator->lastPage()}}
        </a>
      @endif
    </div>
  </div>
</div>
@endif