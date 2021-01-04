@extends('acp.dev.base')

@section('content')
<p>
  @if (request('hide_finished'))
    <a class="btn btn-default py-1" href="{{ UrlHelper::filter(['hide_finished' => null]) }}">Показать все</a>
  @else
    <a class="btn btn-default py-1" href="{{ UrlHelper::filter(['hide_finished' => 1]) }}">Скрыть переведенные</a>
  @endif
</p>
<table class="table-stats table-adaptive">
  <thead>
    <tr>
      <th>Шаблон</th>
      <th class="md:text-right">@svg (picture-o)</th>
      @foreach (config('cfg.locales') as $key => $value)
        <th class="md:text-right uppercase">{{ $key }}</th>
      @endforeach
    </tr>
  </thead>
  <tfoot>
    <tr>
      <td><strong>Итого: {{ sizeof($templates) }}</strong></td>
      <td class="md:text-right whitespace-nowrap">{{ ViewHelper::number($total->pics) }}</td>
      @foreach (config('cfg.locales') as $key => $value)
        <td class="md:text-right whitespace-nowrap">{{ ViewHelper::number($total->{$key}) }}</td>
      @endforeach
    </tr>
  </tfoot>
  <tbody>
    @foreach ($templates as $template)
      <tr>
        <td>
          <a href="{{ path([$controller, 'show'], $template->name)}}">
            {{ $template->name }}
          </a>
        </td>
        <td class="md:text-right">{{ $template->pics ?: '—' }}</td>
        @foreach (config('cfg.locales') as $key => $value)
          <td class="md:text-right">{{ $template->i18n->{$key} ?: '—' }}</td>
        @endforeach
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
