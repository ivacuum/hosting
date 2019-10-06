@extends('acp.list', [
  'searchForm' => true,
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
    <th class="whitespace-no-wrap">
      @include('acp.tpl.sortable-header', ['key' => 'level', 'order' => 'asc'])
    </th>
    <th>{{ ViewHelper::modelFieldTrans($modelTpl, 'character') }}</th>
    <th class="whitespace-no-wrap">
      @include('acp.tpl.sortable-header', ['key' => 'meaning', 'order' => 'asc'])
    </th>
    <th class="md:text-right whitespace-no-wrap">
      @include('acp.tpl.sortable-header', ['key' => 'kanjis_count'])
    </th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($controller, $model) }}">
      <td>{{ $model->level }}</td>
      <td>
        <a
          class="bg-radical block font-bold pb-1 px-2 rounded text-center text-white hover:text-gray-200"
          href="{{ path([$controller, 'show'], $model) }}"
        >
          @if ($model->character)
            <span class="inline-block ja-big ja-character ja-shadow">{{ $model->character }}</span>
          @else
            <img class="ja-character ja-image-shadow mt-1 h-16" src="{{ $model->image }}" alt="">
          @endif
        </a>
      </td>
      <td>{{ $model->meaning }}</td>
      <td class="md:text-right whitespace-no-wrap">
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
