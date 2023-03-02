<p
  @class([
    'text-right' => ($content->data->alignment ?? null) === 'right',
    'text-center' => ($content->data->alignment ?? null) === 'center',
    'text-justify' => ($content->data->alignment ?? null) === 'justify',
  ])
>
  {!! $content->data->text !!}
</p>