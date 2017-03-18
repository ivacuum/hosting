@extends('acp.list')

@section('toolbar')
<ul class="nav nav-link-tabs">
  <li class="{{ !$filter ? 'active' : '' }}">
    <a class="js-pjax" href="{{ Request::fullUrlWithQuery(['filter' => null, 'page' => null]) }}">
      Все
    </a>
  </li>
  <li class="{{ $filter === 'no-tags' ? 'active' : '' }}">
    <a class="js-pjax" href="{{ Request::fullUrlWithQuery(['filter' => 'no-tags', 'page' => null]) }}">
      Без тэгов
    </a>
  </li>
</ul>
@endsection

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th class="text-right">ID</th>
    <th>Фото</th>
    <th>URL</th>
    <th>Тэги</th>
    <th>@svg (map-marker)</th>
    <th class="text-right">@svg (eye)</th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ action("$self@edit", [$model, 'goto' => Request::fullUrl()]) }}">
      <td class="text-right">{{ $model->id }}</td>
      <td class="text-center">
        <a class="screenshot-link" href="{{ action("$self@show", $model) }}">
          <img class="image-100 screenshot" src="{{ $model->thumbnailUrl() }}">
        </a>
      </td>
      <td>{{ $model->slug }}</td>
      <td>
        @foreach ($model->tags as $tag)
          <div>
            <a class="link" href="{{ action('Acp\Tags@show', $tag) }}">#{{ $tag->title }}</a>
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
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
