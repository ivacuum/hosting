@extends('acp.list', [
  'searchForm' => true,
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
    <th class="whitespace-no-wrap">
      @include('acp.tpl.sortable-header', ['key' => 'level', 'order' => 'asc'])
    </th>
    <th>{{ ViewHelper::modelFieldTrans($modelTpl, 'character') }}</th>
    <th class="whitespace-no-wrap">
      @include('acp.tpl.sortable-header', ['key' => 'meaning', 'order' => 'asc'])
    </th>
    <th class="md:text-right whitespace-no-wrap">
      @include('acp.tpl.sortable-header', ['key' => 'radicals_count'])
    </th>
    <th class="md:text-right whitespace-no-wrap">
      @include('acp.tpl.sortable-header', ['key' => 'similar_count'])
    </th>
    <th></th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($controller, $model) }}">
      <td>
        <a class="anchor-sticky" id="{{ $model->getRouteKeyName() }}-{{ $model->getRouteKey() }}"></a>
        {{ $model->level }}
      </td>
      <td>
        <a
          class="bg-kanji block font-bold pb-1 px-2 rounded text-center text-white hover:text-grey-200"
          href="{{ path([$controller, 'show'], $model) }}"
        >
          <span class="inline-block ja-big ja-character ja-shadow">{{ $model->character }}</span>
        </a>
      </td>
      <td class="whitespace-pre-line">{{ implode("\n", explode(', ', $model->meaning)) }}</td>
      <td class="md:text-right whitespace-no-wrap">
        @if ($model->radicals_count > 0)
          <a href="{{ path([App\Http\Controllers\Acp\Radicals::class, 'index'], [$model->getForeignKey() => $model]) }}">
            {{ ViewHelper::number($model->radicals_count) }}
          </a>
        @endif
      </td>
      <td class="md:text-right whitespace-no-wrap">
        @if ($model->similar_count > 0)
          <a href="{{ path([$controller, 'index'], [$model->getForeignKey() => $model]) }}">
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
