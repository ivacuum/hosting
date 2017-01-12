@extends('acp.dev.base')

@section('content')
<h2 class="m-t-0">Доступные шаблоны</h2>
<table class="table-stats">
  <thead>
    <tr>
      <th>Шаблон</th>
      <th>Фото</th>
      @foreach (config('cfg.locales') as $key => $value)
        <th>
          @if ($key === 'ru')
            &#x1f1f7;&#x1f1fa;
          @elseif ($key === 'en')
            &#x1f1ec;&#x1f1e7;
          @else
            {{ $key }}
          @endif
        </th>
      @endforeach
    </tr>
  </thead>
  <tfoot>
    <tr>
      <td><strong>Итого:</strong></td>
      <td>{{ $total->pics }}</td>
      @foreach (config('cfg.locales') as $key => $value)
        <td>{{ $total->{$key} }}</td>
      @endforeach
    </tr>
  </tfoot>
  <tbody>
    @foreach ($templates as $template)
      <tr>
        <td>
          <a class="link" href="{{ action("$self@template", $template->name)}}">
            {{ $template->name }}
          </a>
        </td>
        <td>{{ $template->pics }}</td>
        @foreach (config('cfg.locales') as $key => $value)
          <td>{{ $template->i18n->{$key} }}</td>
        @endforeach
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
