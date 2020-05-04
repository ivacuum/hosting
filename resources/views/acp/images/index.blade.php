<?php
/** @var App\Image $model */
?>

@extends('acp.list')

@section('toolbar')
<div class="flex flex-wrap mb-2">
  <div class="flex mb-2 mr-2">
    <a class="btn btn-default rounded-r-none {{ !$year ? 'active' : '' }}" href="{{ UrlHelper::filter(['year' => null]) }}">Все</a>
    @foreach (range(date('Y'), 2009) as $value)
      <a class="btn btn-default -ml-px {{ $loop->last ? 'rounded-l-none rounded-r' : 'rounded-none' }} {{ $year == $value ? 'active' : '' }}" href="{{ UrlHelper::filter(['year' => $value]) }}">{{ substr($value, 2) }}</a>
    @endforeach
  </div>
  <div class="flex mb-2">
    <a class="btn btn-default rounded-r-none {{ !$touch ? 'active' : '' }}" href="{{ UrlHelper::filter(['touch' => null]) }}">Все</a>
    @foreach (range(1, date('Y') - 2009) as $value)
      <a class="btn btn-default -ml-px {{ $loop->last ? 'rounded-l-none rounded-r' : 'rounded-none' }} {{ $touch == $value ? 'active' : '' }}" href="{{ UrlHelper::filter(['touch' => $value]) }}">{{ $value }}</a>
    @endforeach
  </div>
</div>
@endsection

@section('content-list')
<table class="table-stats table-stats-align-top table-adaptive">
  <thead>
    <tr>
      <th><input type="checkbox" class="form-checkbox js-select-all" data-selector=".models-checkbox"></th>
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
        <td><input class="form-checkbox models-checkbox" type="checkbox" name="ids[]" value="{{ $model->id }}"></td>
        <td class="md:text-right">{{ $model->id }}</td>
        <td class="md:text-right">
          <a href="{{ UrlHelper::filter(['user_id' => $model->user_id]) }}">
            {{ $model->user_id }}
          </a>
        </td>
        <td class="text-center">
          <a class="screenshot-link" href="{{ path([$controller, 'show'], $model) }}">
            <img class="inline-block screenshot" src="{{ $model->thumbnailSecretUrl() }}" alt="">
          </a>
        </td>
        <td class="md:text-right text-muted whitespace-no-wrap">{{ ViewHelper::size($model->size) }}</td>
        <td class="md:text-right whitespace-no-wrap">
          @if ($model->views > 3000)
            <span class="flex bg-greenish-600 text-white px-2 text-xs font-bold rounded">{{ ViewHelper::number($model->views) }}</span>
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
          <div class="flex">
            <a class="btn btn-default rounded-r-none" href="{{ path([$controller, 'view'], $model) }}">
              @svg (eye)
            </a>
            <a
              class="btn btn-default rounded-l-none -ml-px js-image-delete"
              data-confirm="{{ $model->views >= 3000 ? 'Запись будет удалена. Продолжить?' : '' }}"
              data-selector="#image_{{ $model->id }}"
              href="{{ path([$controller, 'destroy'], $model) }}"
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
