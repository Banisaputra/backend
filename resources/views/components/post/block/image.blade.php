<figure>
  <img src="{{$content->data->file->url}}" alt="{{$content->data->caption ?? ''}}" onerror="OnImageError(event)">
  @if ($content->data->caption)
    <figcaption>{{ $content->data->caption }}</figcaption>
  @endif
</figure>