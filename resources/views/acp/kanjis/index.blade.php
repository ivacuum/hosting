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
    <th class="md:tw-text-right tw-whitespace-no-wrap">
      @include('acp.tpl.sortable-header', ['key' => 'radicals_count'])
    </th>
    <th class="md:tw-text-right tw-whitespace-no-wrap">
      @include('acp.tpl.sortable-header', ['key' => 'similar_count'])
    </th>
    <th></th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($self, $model) }}">
      <td>
        <a class="anchor-sticky" id="{{ $model->getRouteKeyName() }}-{{ $model->getRouteKey() }}"></a>
        {{ $model->level }}
      </td>
      <td>
        <a class="bg-kanji d-block tw-font-bold tw-pb-1 tw-px-2 rounded tw-text-center text-white" href="{{ path("$self@show", $model) }}">
          <span class="d-inline-block ja-big ja-character ja-shadow">{{ $model->character }}</span>
        </a>
      </td>
      <td class="pre-line">{{ implode("\n", explode(', ', $model->meaning)) }}</td>
      <td class="md:tw-text-right tw-whitespace-no-wrap">
        @if ($model->radicals_count > 0)
          <a href="{{ path('Acp\Radicals@index', [$model->getForeignKey() => $model]) }}">
            {{ ViewHelper::number($model->radicals_count) }}
          </a>
        @endif
      </td>
      <td class="md:tw-text-right tw-whitespace-no-wrap">
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
