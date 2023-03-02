@php
  $tag = $content->data->style == 'ordered' ? 'ol' : 'ul';
@endphp

<{{$tag}}>
  @foreach ($content->data->items as $item)
    <li>{{$item}}</li>
  @endforeach
</{{$tag}}>