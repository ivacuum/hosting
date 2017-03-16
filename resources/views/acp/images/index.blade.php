@extends('acp.base')

@section('content')
<h3 class="mt-0">
  {{ trans("$tpl.index") }}
  <small>{{ ViewHelper::number($models->total()) }}</small>
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
    <a class="btn btn-default {{ !$year ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['year' => null, 'page' => null]) }}">Все</a>
    <a class="btn btn-default {{ $year == 2016 ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['year' => 2016, 'page' => null]) }}">16</a>
    <a class="btn btn-default {{ $year == 2015 ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['year' => 2015, 'page' => null]) }}">15</a>
    <a class="btn btn-default {{ $year == 2014 ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['year' => 2014, 'page' => null]) }}">14</a>
    <a class="btn btn-default {{ $year == 2013 ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['year' => 2013, 'page' => null]) }}">13</a>
    <a class="btn btn-default {{ $year == 2012 ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['year' => 2012, 'page' => null]) }}">12</a>
    <a class="btn btn-default {{ $year == 2011 ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['year' => 2011, 'page' => null]) }}">11</a>
    <a class="btn btn-default {{ $year == 2010 ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['year' => 2010, 'page' => null]) }}">10</a>
    <a class="btn btn-default {{ $year == 2009 ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['year' => 2009, 'page' => null]) }}">09</a>
  </div>
  <div class="btn-group">
    <a class="btn btn-default {{ !$touch ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['touch' => null, 'page' => null]) }}">Все</a>
    <a class="btn btn-default {{ $touch == 1 ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['touch' => 1, 'page' => null]) }}">1</a>
    <a class="btn btn-default {{ $touch == 2 ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['touch' => 2, 'page' => null]) }}">2</a>
    <a class="btn btn-default {{ $touch == 3 ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['touch' => 3, 'page' => null]) }}">3</a>
    <a class="btn btn-default {{ $touch == 4 ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['touch' => 4, 'page' => null]) }}">4</a>
    <a class="btn btn-default {{ $touch == 5 ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['touch' => 5, 'page' => null]) }}">5</a>
    <a class="btn btn-default {{ $touch == 6 ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['touch' => 6, 'page' => null]) }}">6</a>
    <a class="btn btn-default {{ $touch == 7 ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['touch' => 7, 'page' => null]) }}">7</a>
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
    <table class="table-stats table-adaptive">
      <thead>
        <tr>
          <th><input type="checkbox" class="js-select-all" data-selector=".models-checkbox"></th>
          <th class="text-right">ID</th>
          <th class="text-center">Изображение</th>
          <th class="text-right">Размер</th>
          <th class="text-right">@svg (eye)</th>
          <th>@svg (eye-slash)</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($models as $model)
          <tr class="js-tick-onclick" data-tick="#checkbox_{{ $model->id }}">
            <td><input class="models-checkbox" type="checkbox" id="checkbox_{{ $model->id }}" name="ids[]" value="{{ $model->id }}"></td>
            <td class="text-right">{{ $model->id }}</td>
            <td class="text-center">
              <a class="screenshot-link" href="{{ action("$self@show", $model) }}">
                <img class="screenshot" src="{{ $model->thumbnailSecretUrl() }}">
              </a>
            </td>
            <td class="text-right text-muted">{{ ViewHelper::size($model->size) }}</td>
            <td class="text-right">
              @if ($model->views > 1500)
                <span class="label label-success">{{ ViewHelper::number($model->views) }}</span>
              @else
                {{ ViewHelper::number($model->views) }}
              @endif
            </td>
            <td>
              @if (!is_null($model->updated_at) && $model->updated_at->diffInMonths() > 6)
                {{ $model->updated_at->diffForHumans(null, true) }}
              @endif
            </td>
            <td>
              <div class="btn-group">
                <a class="btn btn-default" href="{{ action("$self@view", $model) }}">
                  @svg (eye)
                </a>
                <a class="btn btn-default js-entity-action" data-confirm="Запись будет удалена. Продолжить?" data-method="delete" href="{{ action("$self@destroy", $model) }}">
                  @svg (trash-o)
                </a>
              </div>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <div class="mt-3">
      <form class="form-inline js-batch-form" data-url="{{ action("$self@batch") }}" data-selector=".models-checkbox">
        <div class="form-group">
          <input type="checkbox" class="js-select-all" data-selector=".models-checkbox">
          <div class="form-select d-inline-block mx-1">
            <select class="form-control" name="action" id="batch_action">
              <option value="">Выберите действие...</option>
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

  @include('tpl.paginator', ['paginator' => $models])
@endif
@endsection
