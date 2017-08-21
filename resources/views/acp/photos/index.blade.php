@extends('acp.list')

@section('toolbar')
<ul class="nav nav-link-tabs">
  <li class="{{ !$filter ? 'active' : '' }}">
    <a class="js-pjax" href="{{ UrlHelper::filter(['filter' => null]) }}">
      Все
    </a>
  </li>
  <li class="{{ $filter === 'no-tags' ? 'active' : '' }}">
    <a class="js-pjax" href="{{ UrlHelper::filter(['filter' => 'no-tags']) }}">
      Без тэгов
    </a>
  </li>
  <li class="{{ $filter === 'no-geo' ? 'active' : '' }}">
    <a class="js-pjax" href="{{ UrlHelper::filter(['filter' => 'no-geo']) }}">
      Без гео
    </a>
  </li>
</ul>
@endsection

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th class="text-right text-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'id'])
    </th>
    <th>Фото</th>
    <th>URL</th>
    <th>Тэги</th>
    <th>@svg (map-marker)</th>
    <th class="text-right text-nowrap">
      @include('acp.tpl.sortable-header', ['key' => 'views', 'svg' => 'eye'])
    </th>
    <th></th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($self, $model) }}">
      <td class="text-right">{{ $model->id }}</td>
      <td class="text-center">
        <a class="screenshot-link" href="{{ path("$self@show", $model) }}">
          <img class="image-100 screenshot" src="{{ $model->thumbnailUrl() }}">
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
      <td class="text-right">
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
