<table>
  @if ($content->data->withHeadings)
    <thead>
      <tr>
        @foreach ($content->data->content[0] as $column)
          <th>{{ $column }}</th>
        @endforeach
      </tr>
    </thead>      
  @endif
  <tbody>
    @foreach ($content->data->content as $index => $row)
      @if ($content->data->withHeadings && $index === 0)
        @continue
      @endif

      <tr>
        @foreach ($row as $column)
          <td>{{ $column }}</td> 
        @endforeach
      </tr>
    @endforeach
  </tbody>
</table>