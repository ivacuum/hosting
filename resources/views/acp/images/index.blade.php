@extends('acp.list')

@section('toolbar')
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
    @foreach (range(date('Y'), 2009) as $value)
      <a class="btn btn-default {{ $year == $value ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['year' => $value, 'page' => null]) }}">{{ substr($value, 2) }}</a>
    @endforeach
  </div>
  <div class="btn-group">
    <a class="btn btn-default {{ !$touch ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['touch' => null, 'page' => null]) }}">Все</a>
    @foreach (range(1, date('Y') - 2009) as $value)
      <a class="btn btn-default {{ $touch == $value ? 'selected' : '' }}" href="{{ Request::fullUrlWithQuery(['touch' => $value, 'page' => null]) }}">{{ $value }}</a>
    @endforeach
  </div>
</div>
@endsection

@section('content-list')
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
@endsection
