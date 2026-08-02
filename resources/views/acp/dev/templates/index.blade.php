@extends('acp.dev.base')

@section('content')
<div class="flex flex-wrap -mt-2 mb-2">
  @include('acp.tpl.dropdown-filter', [
    'field' => 'finished',
    'title' => __('Готово'),
    'values' => [
      __('Нет') => null,
      '---' => null,
      __('Да') => 'yes',
      __('Неважно') => 'any',
    ],
  ])
  @include('acp.tpl.dropdown-filter', [
    'field' => 'translated',
    'title' => __('Переведено'),
    'values' => [
      __('Неважно') => null,
      '---' => null,
      __('Да') => 1,
      __('Нет') => 0,
    ],
  ])
</div>
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
