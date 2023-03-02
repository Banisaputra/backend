@if ($content->data->file->extension === 'xlsx')
  <iframe class="w-full h-[450px] mb-5" src="https://view.officeapps.live.com/op/embed.aspx?src={{ $content->data->file->url }}"></iframe>
@elseif ($content->data->file->extension === 'pdf')
  <iframe class="w-full h-[450px] mb-5" src="https://docs.google.com/viewer?url={{ $content->data->file->url }}&embedded=true"></iframe>
@else
  <div>
    <a href="{{ Storage::url($content->data->file->url) }}">
      Download {{ $content->data->title }}
    </a>
  </div>
@endif