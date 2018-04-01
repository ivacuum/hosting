@extends('acp.list', [
  'search_form' => true,
])

@section('heading-after-search')
@include('acp.tpl.dropdown-filter', [
  'field' => 'similar_count',
  'values' => [
    'Все' => null,
    '---' => null,
    'Есть' => 1,
    'Нет' => 0,
  ]
])
@endsection

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th class="text-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'level', 'order' => 'asc'])
    </th>
    <th>{{ ViewHelper::modelFieldTrans($model_tpl, 'character') }}</th>
    <th class="text-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'meaning', 'order' => 'asc'])
    </th>
    <th class="text-md-right text-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'radicals_count'])
    </th>
    <th class="text-md-right text-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'similar_count'])
    </th>
    <th></th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($self, $model) }}">
      <td>{{ $model->level }}</td>
      <td>
        <a class="anchor-sticky" name="id-{{ $model->id }}"></a>
        <a class="bg-kanji d-block font-weight-bold pb-1 px-2 rounded text-center text-white" href="{{ path("$self@show", $model) }}">
          <span class="d-inline-block ja-big ja-character ja-shadow">{{ $model->character }}</span>
        </a>
      </td>
      <td>{{ $model->meaning }}</td>
      <td class="text-md-right text-nowrap">
        @if ($model->radicals_count > 0)
          <a href="{{ path('Acp\Radicals@index', [$model->getForeignKey() => $model]) }}">
            {{ ViewHelper::number($model->radicals_count) }}
          </a>
        @endif
      </td>
      <td class="text-md-right text-nowrap">
        @if ($model->similar_count > 0)
          <a href="{{ path("$self@index", [$model->getForeignKey() => $model]) }}">
            {{ ViewHelper::number($model->similar_count) }}
          </a>
        @endif
      </td>
      <th>
        <a href="{{ $model->externalLink() }}" rel="noreferrer">
          @svg (external-link)
        </a>
      </th>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
