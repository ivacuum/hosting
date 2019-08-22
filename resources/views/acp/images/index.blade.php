<?php
/** @var App\Image $model */
?>

@extends('acp.list')

@section('toolbar')
<div class="btn-toolbar tw-mb-4">
  <div class="btn-group tw-mr-2">
    <a class="btn btn-default js-pjax {{ !$type ? 'active' : '' }}" href="{{ UrlHelper::filter(['type' => null]) }}">
      @svg (th-list)
    </a>
    <a class="btn btn-default js-pjax {{ $type == 'grid' ? 'active' : '' }}" href="{{ UrlHelper::filter(['type' => 'grid']) }}">
      @svg (th)
    </a>
  </div>
  <div class="btn-group tw-mr-2">
    <a class="btn btn-default js-pjax {{ !$year ? 'active' : '' }}" href="{{ UrlHelper::filter(['year' => null]) }}">Все</a>
    @foreach (range(date('Y'), 2009) as $value)
      <a class="btn btn-default js-pjax {{ $year == $value ? 'active' : '' }}" href="{{ UrlHelper::filter(['year' => $value]) }}">{{ substr($value, 2) }}</a>
    @endforeach
  </div>
  <div class="btn-group">
    <a class="btn btn-default js-pjax {{ !$touch ? 'active' : '' }}" href="{{ UrlHelper::filter(['touch' => null]) }}">Все</a>
    @foreach (range(1, date('Y') - 2009) as $value)
      <a class="btn btn-default js-pjax {{ $touch == $value ? 'active' : '' }}" href="{{ UrlHelper::filter(['touch' => $value]) }}">{{ $value }}</a>
    @endforeach
  </div>
</div>
@endsection

@section('content-list')
@if (!$type)
  <table class="table-stats table-stats-align-top table-adaptive">
    <thead>
      <tr>
        <th><input type="checkbox" class="js-select-all" data-selector=".models-checkbox"></th>
        <th class="md:tw-text-right tw-whitespace-no-wrap">
          @include('acp.tpl.sortable-header', ['key' => 'id'])
        </th>
        <th class="md:tw-text-right tw-whitespace-no-wrap">Автор</th>
        <th class="tw-text-center">Изображение</th>
        <th class="md:tw-text-right tw-whitespace-no-wrap">
          @include('acp.tpl.sortable-header', ['key' => 'size'])
        </th>
        <th class="md:tw-text-right tw-whitespace-no-wrap">
          @include('acp.tpl.sortable-header', ['key' => 'views', 'svg' => 'eye'])
        </th>
        <th>
          @include('acp.tpl.sortable-header', ['key' => 'updated_at', 'svg' => 'eye-slash'])
        </th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($models as $model)
        <tr id="image_{{ $model->id }}">
          <td><input class="models-checkbox" type="checkbox" name="ids[]" value="{{ $model->id }}"></td>
          <td class="md:tw-text-right">{{ $model->id }}</td>
          <td class="md:tw-text-right">
            <a href="{{ UrlHelper::filter(['user_id' => $model->user_id]) }}">
              {{ $model->user_id }}
            </a>
          </td>
          <td class="tw-text-center">
            <a class="screenshot-link" href="{{ path("$self@show", $model) }}">
              <img class="screenshot" src="{{ $model->thumbnailSecretUrl() }}">
            </a>
          </td>
          <td class="md:tw-text-right text-muted tw-whitespace-no-wrap">{{ ViewHelper::size($model->size) }}</td>
          <td class="md:tw-text-right tw-whitespace-no-wrap">
            @if ($model->views > 3000)
              <span class="tw-flex tw-bg-green-600 tw-text-white tw-px-2 tw-text-xs tw-font-bold tw-rounded">{{ ViewHelper::number($model->views) }}</span>
            @else
              {{ ViewHelper::number($model->views) }}
            @endif
          </td>
          <td>
            @if (optional($model->updated_at)->diffInMonths() > 6)
              {{ $model->updated_at->diffForHumans(null, true) }}
            @endif
          </td>
          <td>
            <div class="btn-group">
              <a class="btn btn-default" href="{{ path("$self@view", $model) }}">
                @svg (eye)
              </a>
              <a
                class="btn btn-default js-image-delete"
                data-confirm="{{ $model->views >= 3000 ? 'Запись будет удалена. Продолжить?' : '' }}"
                data-selector="#image_{{ $model->id }}"
                href="{{ path("$self@destroy", $model) }}"
              >
                @svg (trash-o)
              </a>
            </div>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>

  <div class="tw-mt-4">
    @include('acp.tpl.batch', ['actions' => [
      'delete' => 'Удалить',
    ]])
  </div>
@elseif ($type === 'grid')
  <div class="tw-text-center">
    @foreach ($models as $model)
      <a class="tw-inline-block tw-relative" href="{{ path("$self@show", $model) }}">
        <img class="tw-max-w-full" src="{{ $model->thumbnailSecretUrl() }}">
        <span class="image-label">@svg (eye) {{ $model->views }} &middot; {{ ViewHelper::size($model->size) }}</span>
      </a>
    @endforeach
  </div>
@endif
@endsection

@push('js')
<script type="module">
$(document).on('click', '.js-image-delete', function jsImageDelete(e) {
  e.preventDefault()

  const $this = $(this)
  const confirmText = this.dataset.confirm

  if ($this.hasClass('disabled')) {
    return false
  }

  if (confirmText) {
    if (!confirm(confirmText)) {
      return false
    }
  }

  $this.addClass('disabled')

  axios
    .post($this.attr('href'), {
      _method: 'delete'
    })
    .then((response) => {
      if (response.data.status === 'OK') {
        document.querySelector($this.data('selector')).hidden = true
      } else {
        notie.alert({ type: 'error', text: response.data.message })
      }
    })
    .catch((error) => {
      notie.alert({ type: 'error', text: error.response.data.message, stay: true })
    })

  return true
})
</script>
@endpush
