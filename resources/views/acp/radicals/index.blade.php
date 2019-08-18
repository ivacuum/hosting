@extends('acp.list', [
  'search_form' => true,
])

@section('heading-after-search')
@include('acp.tpl.dropdown-filter', [
  'field' => 'kanjis_count',
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
    <th>{{ ViewHelper::modelFieldTrans($model_tpl, 'character') }}</th>
    <th class="tw-whitespace-no-wrap">
      @include('acp.tpl.sortable-header', ['key' => 'meaning', 'order' => 'asc'])
    </th>
    <th class="text-md-right tw-whitespace-no-wrap">
      @include('acp.tpl.sortable-header', ['key' => 'kanjis_count'])
    </th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($self, $model) }}">
      <td>{{ $model->level }}</td>
      <td>
        <a class="bg-radical d-block font-weight-bold pb-1 px-2 rounded text-center text-white" href="{{ path("$self@show", $model) }}">
          @if ($model->character)
            <span class="d-inline-block ja-big ja-character ja-shadow">{{ $model->character }}</span>
          @else
            <img class="ja-character ja-image-shadow tw-mt-1" src="{{ $model->image }}" height="72">
          @endif
        </a>
      </td>
      <td>{{ $model->meaning }}</td>
      <td class="text-md-right tw-whitespace-no-wrap">
        @if ($model->kanjis_count > 0)
          <a href="{{ path('Acp\Kanjis@index', [$model->getForeignKey() => $model]) }}">
            {{ ViewHelper::number($model->kanjis_count) }}
          </a>
        @endif
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
