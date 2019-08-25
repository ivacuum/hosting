<?php
/** @var App\Image $model */
?>

@extends('acp.list')

@section('toolbar')
<div class="btn-toolbar mb-4">
  <div class="btn-group mr-2">
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
<table class="table-stats table-stats-align-top table-adaptive">
  <thead>
    <tr>
      <th><input type="checkbox" class="js-select-all" data-selector=".models-checkbox"></th>
      <th class="md:text-right whitespace-no-wrap">
        @include('acp.tpl.sortable-header', ['key' => 'id'])
      </th>
      <th class="md:text-right whitespace-no-wrap">Автор</th>
      <th class="text-center">Изображение</th>
      <th class="md:text-right whitespace-no-wrap">
        @include('acp.tpl.sortable-header', ['key' => 'size'])
      </th>
      <th class="md:text-right whitespace-no-wrap">
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
        <td class="md:text-right">{{ $model->id }}</td>
        <td class="md:text-right">
          <a href="{{ UrlHelper::filter(['user_id' => $model->user_id]) }}">
            {{ $model->user_id }}
          </a>
        </td>
        <td class="text-center">
          <a class="screenshot-link" href="{{ path("$self@show", $model) }}">
            <img class="screenshot" src="{{ $model->thumbnailSecretUrl() }}">
          </a>
        </td>
        <td class="md:text-right text-muted whitespace-no-wrap">{{ ViewHelper::size($model->size) }}</td>
        <td class="md:text-right whitespace-no-wrap">
          @if ($model->views > 3000)
            <span class="flex bg-green-600 text-white px-2 text-xs font-bold rounded">{{ ViewHelper::number($model->views) }}</span>
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

<div class="mt-4">
  @include('acp.tpl.batch', ['actions' => [
    'delete' => 'Удалить',
  ]])
</div>
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
