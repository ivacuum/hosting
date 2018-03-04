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
            <img class="flag-24 flag-shadow" src="https://ivacuum.org/i/flags/svg/ru.svg">
          @elseif ($key === 'en')
            <img class="flag-24 flag-shadow" src="https://ivacuum.org/i/flags/svg/us.svg">
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
