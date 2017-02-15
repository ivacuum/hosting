@extends('acp.base')

@section('content')
<h3 class="mt-0">
  {{ trans("$tpl.index") }}
  <small>
    {{ ViewHelper::number($models->total()) }}
    <span class="mx-1">&middot;</span>
    {{ ViewHelper::size($size) }}
  </small>
</h3>
<div class="btn-toolbar mb-3">
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
    <a class="btn btn-default {{ $year == 2015 ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['year' => 2015, 'page' => 1]) }}">15</a>
    <a class="btn btn-default {{ $year == 2014 ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['year' => 2014, 'page' => 1]) }}">14</a>
    <a class="btn btn-default {{ $year == 2013 ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['year' => 2013, 'page' => 1]) }}">13</a>
    <a class="btn btn-default {{ $year == 2012 ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['year' => 2012, 'page' => 1]) }}">12</a>
    <a class="btn btn-default {{ $year == 2011 ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['year' => 2011, 'page' => 1]) }}">11</a>
    <a class="btn btn-default {{ $year == 2010 ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['year' => 2010, 'page' => 1]) }}">10</a>
    <a class="btn btn-default {{ $year == 2009 ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['year' => 2009, 'page' => 1]) }}">09</a>
  </div>
  <div class="btn-group">
    <a class="btn btn-default {{ !$touch ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['touch' => null, 'page' => 1]) }}">Все</a>
    <a class="btn btn-default {{ $touch == 1 ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['touch' => 1, 'page' => 1]) }}">1</a>
    <a class="btn btn-default {{ $touch == 2 ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['touch' => 2, 'page' => 1]) }}">2</a>
    <a class="btn btn-default {{ $touch == 3 ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['touch' => 3, 'page' => 1]) }}">3</a>
    <a class="btn btn-default {{ $touch == 4 ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['touch' => 4, 'page' => 1]) }}">4</a>
    <a class="btn btn-default {{ $touch == 5 ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['touch' => 5, 'page' => 1]) }}">5</a>
    <a class="btn btn-default {{ $touch == 6 ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['touch' => 6, 'page' => 1]) }}">6</a>
    <a class="btn btn-default {{ $touch == 7 ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['touch' => 7, 'page' => 1]) }}">7</a>
  </div>
</div>
@if ($user_id)
  <div class="my-3">
    <a class="btn btn-default" href="{{ action("$self@index") }}">
      Сбросить все фильтры
      <span class="text-danger">
        @svg (times)
      </span>
    </a>
    <a class="btn btn-default" href="{{ Request::fullUrlWithQuery(['user_id' => null, 'page' => null]) }}">
      user_id: {{ $user_id }}
      <span class="text-danger">
        @svg (times)
      </span>
    </a>
  </div>
@endif
@if (sizeof($models))
  @if (!$type)
    <div class="flex-table flex-table-bordered">
      <div class="flex-row flex-row-header">
        <div class="flex-cell"><input type="checkbox" class="js-select-all" data-selector=".models-checkbox"></div>
        <div class="flex-cell text-right">ID</div>
        <div class="flex-cell">Изображение</div>
        <div class="flex-cell">Размер</div>
        <div class="flex-cell text-right">@svg (eye)</div>
        <div class="flex-cell">@svg (eye-slash)</div>
        <div class="flex-cell"></div>
      </div>
      <div class="flex-row-group flex-row-striped">
        @foreach ($models as $model)
          <div class="flex-row js-tick-onclick" data-tick="#checkbox_{{ $model->id }}">
            <div class="flex-cell"><input class="models-checkbox" type="checkbox" id="checkbox_{{ $model->id }}" name="ids[]" value="{{ $model->id }}"></div>
            <div class="flex-cell text-right">{{ $model->id }}</div>
            <div class="flex-cell">
              <a class="screenshot-link" href="{{ action("$self@show", $model) }}">
                <img class="screenshot" src="{{ $model->thumbnailSecretUrl() }}">
              </a>
            </div>
            <div class="flex-cell text-muted">{{ ViewHelper::size($model->size) }}</div>
            <div class="flex-cell text-right">
              @if ($model->views > 1500)
                <span class="label label-success">{{ ViewHelper::number($model->views) }}</span>
              @else
                {{ ViewHelper::number($model->views) }}
              @endif
            </div>
            <div class="flex-cell">{{ !is_null($model->updated_at) && $model->updated_at->diffInMonths() > 6 ? $model->updated_at->diffForHumans(null, true) : '' }}</div>
            <div class="flex-cell">
              <div class="btn-group">
                <a class="btn btn-default" href="{{ action("$self@view", $model) }}">
                  @svg (eye)
                </a>
                <a class="btn btn-default js-entity-action" data-confirm="Запись будет удалена. Продолжить?" data-method="delete" href="{{ action("$self@destroy", $model) }}">
                  @svg (trash-o)
                </a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>

    <div class="pull-left mt-3">
      <form class="form-inline js-batch-form" data-url="{{ action("$self@batch") }}" data-selector=".models-checkbox">
        <div class="form-group">
          <input type="checkbox" class="js-select-all" data-selector=".models-checkbox">
          <div class="form-select d-inline-block mx-1">
            <select class="form-control" name="action" id="batch_action">
              {{--<option value="">Выберите действие...</option>--}}
              <option value="delete">Удалить</option>
            </select>
          </div>
        </div>
        <button class="btn btn-default" id="batch_submit">Выполнить</button>
      </form>
    </div>
  @elseif ($type === 'grid')
    <div class="text-center">
      @foreach ($models as $model)
        <a class="gallery-photo-container" href="{{ action("$self@show", $model) }}">
          <img class="gallery-photo" src="{{ $model->thumbnailSecretUrl() }}">
          <span class="image-label">@svg (eye) {{ $model->views }} &middot; {{ ViewHelper::size($model->size) }}</span>
        </a>
      @endforeach
    </div>
  @endif

  <div class="mt-3 pull-right clearfix">
    @include('tpl.paginator', ['paginator' => $models])
  </div>
@endif
@endsection
