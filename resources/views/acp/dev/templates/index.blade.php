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
      <x-th>Шаблон</x-th>
      <x-th-numeric>@svg(picture-o)</x-th-numeric>
      @foreach (App\Domain\Config::Locales->get() as $key => $value)
        <x-th-numeric>{{ mb_strtoupper($key) }}</x-th-numeric>
      @endforeach
    </tr>
  </thead>
  <tfoot>
    <tr>
      <td><strong>Итого: {{ count($templates) }}</strong></td>
      <td class="md:text-right whitespace-nowrap">{{ ViewHelper::number($total->pics) }}</td>
      @foreach (App\Domain\Config::Locales->get() as $key => $value)
        <td class="md:text-right whitespace-nowrap">{{ ViewHelper::number($total->{$key}) }}</td>
      @endforeach
    </tr>
  </tfoot>
  <tbody>
    @foreach ($templates as $template)
      <tr>
        <td>
          <a href="{{ $template->www }}">
            {{ $template->name }}
          </a>
        </td>
        <td class="md:text-right">{{ $template->pics ?: '—' }}</td>
        @foreach (App\Domain\Config::Locales->get() as $key => $value)
          <td class="md:text-right">{{ $template->i18n->{$key} ?: '—' }}</td>
        @endforeach
      </tr>
    @endforeach
  </tbody>
</table>
@endsection
