@extends('acp.dev.base')

@section('content')
<p>
  <a class="btn btn-default btn-sm" href="{{ UrlHelper::filter(['hide_finished' => 1]) }}">Скрыть переведенные</a>
</p>
<table class="table-stats table-adaptive">
  <thead>
    <tr>
      <th>Шаблон</th>
      <th class="text-md-right">@svg (picture-o)</th>
      @foreach (config('cfg.locales') as $key => $value)
        <th class="text-md-right">
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
      <td><strong>Итого: {{ sizeof($templates) }}</strong></td>
      <td class="text-md-right">{{ ViewHelper::number($total->pics) }}</td>
      @foreach (config('cfg.locales') as $key => $value)
        <td class="text-md-right">{{ ViewHelper::number($total->{$key}) }}</td>
      @endforeach
    </tr>
  </tfoot>
  <tbody>
    @foreach ($templates as $template)
      <tr>
        <td>
          <a href="{{ path("$self@show", $template->name)}}">
            {{ $template->name }}
          </a>
        </td>
        <td class="text-md-right">{{ $template->pics ?: '—' }}</td>
        @foreach (config('cfg.locales') as $key => $value)
          <td class="text-md-right">{{ $template->i18n->{$key} ?: '—' }}</td>
        @endforeach
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
