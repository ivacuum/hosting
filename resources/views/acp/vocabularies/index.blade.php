@extends('acp.list', [
  'search_form' => true,
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
    <th class="tw-whitespace-no-wrap">
      @include('acp.tpl.sortable-header', ['key' => 'level', 'order' => 'asc'])
    </th>
    <th class="tw-whitespace-no-wrap">{{ ViewHelper::modelFieldTrans($model_tpl, 'character') }}</th>
    <th class="tw-whitespace-no-wrap">
      @include('acp.tpl.sortable-header', ['key' => 'meaning', 'order' => 'asc'])
    </th>
    <th>{{ ViewHelper::modelFieldTrans($model_tpl, 'sentences') }}</th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($self, $model) }}">
      <td>{{ $model->level }}</td>
      <td class="tw-whitespace-no-wrap">
        <a class="bg-vocab tw-block tw-font-bold tw-pb-1 tw-px-2 tw-rounded tw-text-center tw-text-white hover:tw-text-gray-400" href="{{ path("$self@show", $model) }}">
          <span class="tw-inline-block f36 ja-character ja-shadow">{{ $model->character }}</span>
        </a>
      </td>
      <td class="pre-line">{{ implode("\n", explode(', ', $model->meaning)) }}</td>
      <td>{{ !$model->sentences ? 'Нет' : '' }}</td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
