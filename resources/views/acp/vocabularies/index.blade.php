@extends('acp.list', [
  'searchForm' => true,
])

@section('heading-after-search')
@include('acp.tpl.dropdown-filter', [
  'field' => 'sentences',
  'values' => [
    'Все' => null,
    '---' => null,
    'Есть' => 1,
    'Нет' => 0,
  ]
])
@endsection

@section('content-list')
<table class="table-stats table-stats-align-top table-adaptive">
  <thead>
  <tr>
    <th class="whitespace-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'level', 'order' => 'asc'])
    </th>
    <th class="whitespace-nowrap">{{ ViewHelper::modelFieldTrans($modelTpl, 'character') }}</th>
    <th class="whitespace-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'meaning', 'order' => 'asc'])
    </th>
    <th>{{ ViewHelper::modelFieldTrans($modelTpl, 'sentences') }}</th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($controller, $model) }}">
      <td>{{ $model->level }}</td>
      <td class="whitespace-nowrap">
        <a
          class="bg-vocab block pb-1 px-2 rounded text-center text-white hover:text-grey-200"
          href="{{ path([$controller, 'show'], $model) }}"
        >
          <span class="inline-block text-4xl leading-none ja-shadow">{{ $model->character }}</span>
        </a>
      </td>
      <td class="whitespace-pre-line">{{ implode("\n", explode(', ', $model->meaning)) }}</td>
      <td>{{ !$model->sentences ? 'Нет' : '' }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
