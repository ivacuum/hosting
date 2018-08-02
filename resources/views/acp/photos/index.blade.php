@extends('acp.list')

@section('heading-after-search')
@include('acp.tpl.dropdown-filter', [
  'field' => 'filter',
  'values' => [
    'Все' => null,
    '---' => null,
    'Без тэгов' => 'no-tags',
    'Без гео' => 'no-geo',
  ]
])
@endsection

@section('content-list')
<table class="table-stats table-stats-align-top table-adaptive">
  <thead>
  <tr>
    <th class="text-md-right text-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'id'])
    </th>
    <th>Фото</th>
    <th>URL</th>
    <th>Тэги</th>
    <th>@svg (map-marker)</th>
    <th class="text-md-right text-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'views', 'svg' => 'eye'])
    </th>
    <th></th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($self, $model) }}">
      <td class="text-md-right">
        <a class="anchor-sticky" id="{{ $model->getRouteKeyName() }}-{{ $model->getRouteKey() }}"></a>
        {{ $model->id }}
      </td>
      <td class="text-center">
        <a class="d-inline-block screenshot-link" href="{{ path("$self@show", $model) }}">
          <img class="border border-hover image-100" src="{{ request('size') == 2000 ? $model->originalUrl() : (request('size') == 1000 ? $model->mobileUrl() : $model->thumbnailUrl()) }}">
        </a>
      </td>
      <td>
        <div>{{ $model->filename() }}</div>
        <div class="small text-muted">{{ $model->folder() }}</div>
      </td>
      <td>
        @foreach ($model->tags as $tag)
          <div>
            <a href="{{ path('Acp\Tags@show', $tag) }}">#{{ $tag->title }}</a>
          </div>
        @endforeach
      </td>
      <td>
        <div>{{ $model->lat }}</div>
        <div>{{ $model->lon }}</div>
      </td>
      <td class="text-md-right text-nowrap">
        @if ($model->views > 0)
          {{ ViewHelper::number($model->views) }}
        @endif
      </td>
      <td>
        <div class="desktop-hidden">
          <a class="btn btn-default" href="{{ UrlHelper::edit($self, $model) }}">
            @svg (pencil)
          </a>
        </div>
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
