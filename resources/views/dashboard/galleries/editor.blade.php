@extends('layouts.post-editor', ['type' => 'gallery', 'backUrl' => route('galleries.index')])

@push('script')
<script>
  window.EditorTools = {
    paragraph: {
      class: Paragraph,
      config: {
        placeholder: 'Type a content...',
      },
    },
    embed: Embed,
    image: {
      class: ImageTool,
      config: {
        field: 'file',
        endpoints: {
          byFile: @json(route('uploads.store')),
        },
      },
    },
  }
</script>
@endpush