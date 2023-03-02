@extends('layouts.post-editor', ['type' => 'article', 'backUrl' => route('articles.index')])

@push('script')
<script>
  window.EditorTools = {
    paragraph: {
      class: Paragraph,
      config: {
        placeholder: 'Type a content...',
      },
    },
    header: {
      class: Header,
      config: {
        levels: [2, 3, 4],
      },
    },
    embed: Embed,
    table: Table,
    delimiter: Delimiter,
    list: {
      class: List,
      inlineToolbar: true,
      config: {
        defaultStyle: 'unordered',
      },
    },
    image: {
      class: ImageTool,
      config: {
        field: 'file',
        endpoints: {
          byFile: @json(route('uploads.store')),
        },
      },
    },
    attaches: {
      class: AttachesTool,
      config: {
        endpoint: @json(route('uploads.store')),
        errorMessage: 'Gagal mengupload file',
      }
    },
    raw: RawHTML,
  }
</script>
@endpush