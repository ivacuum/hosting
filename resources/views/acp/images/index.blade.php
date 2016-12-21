@extends('acp.base')

@section('content')
<h3>
  {{ trans("$tpl.index") }}
  <small>{{ ViewHelper::number($models->total()) }}</small>
</h3>
<div class="btn-toolbar m-b-1">
  <div class="btn-group">
    <a class="btn btn-default {{ !$type ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['type' => null]) }}">
      @svg (th-list)
    </a>
    <a class="btn btn-default {{ $type == 'grid' ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['type' => 'grid']) }}">
      @svg (th)
    </a>
  </div>
  <div class="btn-group">
    <a class="btn btn-default {{ !$year ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['year' => null, 'page' => 1]) }}">Все</a>
    <a class="btn btn-default {{ $year == 2016 ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['year' => 2016, 'page' => 1]) }}">16</a>
    <a class="btn btn-default" href="{{ Request::fullUrlWithQuery(['year' => 2015, 'page' => 1]) }}">15</a>
    <a class="btn btn-default" href="{{ Request::fullUrlWithQuery(['year' => 2014, 'page' => 1]) }}">14</a>
    <a class="btn btn-default" href="{{ Request::fullUrlWithQuery(['year' => 2013, 'page' => 1]) }}">13</a>
    <a class="btn btn-default" href="{{ Request::fullUrlWithQuery(['year' => 2012, 'page' => 1]) }}">12</a>
    <a class="btn btn-default" href="{{ Request::fullUrlWithQuery(['year' => 2011, 'page' => 1]) }}">11</a>
    <a class="btn btn-default" href="{{ Request::fullUrlWithQuery(['year' => 2010, 'page' => 1]) }}">10</a>
    <a class="btn btn-default" href="{{ Request::fullUrlWithQuery(['year' => 2009, 'page' => 1]) }}">09</a>
  </div>
  <div class="btn-group">
    <a class="btn btn-default selected" href="{{ Request::fullUrlWithQuery(['touch' => null, 'page' => 1]) }}">Все</a>
    <a class="btn btn-default" href="{{ Request::fullUrlWithQuery(['touch' => 1, 'page' => 1]) }}">1</a>
    <a class="btn btn-default" href="{{ Request::fullUrlWithQuery(['touch' => 2, 'page' => 1]) }}">2</a>
    <a class="btn btn-default" href="{{ Request::fullUrlWithQuery(['touch' => 3, 'page' => 1]) }}">3</a>
    <a class="btn btn-default" href="{{ Request::fullUrlWithQuery(['touch' => 4, 'page' => 1]) }}">4</a>
    <a class="btn btn-default" href="{{ Request::fullUrlWithQuery(['touch' => 5, 'page' => 1]) }}">5</a>
    <a class="btn btn-default" href="{{ Request::fullUrlWithQuery(['touch' => 6, 'page' => 1]) }}">6</a>
    <a class="btn btn-default" href="{{ Request::fullUrlWithQuery(['touch' => 7, 'page' => 1]) }}">7</a>
  </div>
</div>
@if (sizeof($models))
  @if (!$type)
    <table class="table-stats">
      <thead>
        <tr>
          <th><input type="checkbox" class="js-select-all" data-selector=".models-checkbox"></th>
          <th>ID</th>
          <th>Название</th>
          <th>Размер</th>
          <th>@svg (eye)</th>
          <th>Без просмотров</th>
        </tr>
      </thead>
      @foreach ($models as $model)
        <tr>
          <td><input class="models-checkbox" type="checkbox" name="ids[]" value="{{ $model->id }}"></td>
          <td><a class="link" href="{{ action("$self@show", $model) }}">{{ $model->id }}</a></td>
          <td class="text-center"><img src="{{ $model->thumbnailUrl() }}"></td>
          <td class="text-muted">{{ ViewHelper::size($model->size) }}</td>
          <td>{{ ViewHelper::number($model->views) }}</td>
          <td>{{ !is_null($model->updated_at) && $model->updated_at->diffInMonths() > 6 ? $model->updated_at->diffForHumans(null, true) : '' }}</td>
        </tr>
      @endforeach
    </table>

    <div class="pull-left m-y-1">
      <form class="form-inline js-batch-form" data-url="{{ action("$self@batch") }}" data-selector=".models-checkbox">
        <div class="form-group">
          <select class="form-control" name="action" id="batch_action">
            {{--<option value="">Выберите действие...</option>--}}
            <option value="delete">Удалить</option>
          </select>
        </div>
        <button class="btn btn-default" id="batch_submit">Выполнить</button>
      </form>
    </div>
  @elseif ($type === 'grid')
    <div class="text-center">
      @foreach ($models as $model)
        <a class="gallery-photo-container" href="{{ action("$self@show", $model) }}">
          <img class="gallery-photo" src="{{ $model->thumbnailUrl() }}">
          <span class="image-label">@svg (eye) {{ $model->views }} &middot; {{ ViewHelper::size($model->size) }}</span>
        </a>
      @endforeach
    </div>
  @endif

  <div class="m-y-1 pull-right clearfix">
    @include('tpl.paginator', ['paginator' => $models])
  </div>
@endif
@endsection
