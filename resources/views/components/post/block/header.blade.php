@php
  switch ($content->data->level) {
      case '1':
      case '2':
      case '3':
      case '4':
      case '5':
      case '6':
          $tag = 'h' . $content->data->level;
          break;
      default:
          $tag = 'h3';
  };
@endphp

<{{$tag}}>
  {{$content->data->text}}
</{{$tag}}>