@extends('acp.dev.base')

@section('content')
<table class="table-stats table-adaptive">
  <thead>
    <tr>
      <th>Шаблон</th>
      <th class="text-right">Фото</th>
      @foreach (config('cfg.locales') as $key => $value)
        <th class="text-right">
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
      <td class="text-right">{{ ViewHelper::number($total->pics) }}</td>
      @foreach (config('cfg.locales') as $key => $value)
        <td class="text-right">{{ ViewHelper::number($total->{$key}) }}</td>
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
        <td class="text-right">{{ $template->pics ?: '—' }}</td>
        @foreach (config('cfg.locales') as $key => $value)
          <td class="text-right">{{ $template->i18n->{$key} ?: '—' }}</td>
        @endforeach
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
