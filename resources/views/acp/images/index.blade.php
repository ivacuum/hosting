<?php /** @var App\Image $model */ ?>

@extends('acp.list')

@section('toolbar')
<div class="flex flex-wrap mb-2">
  <div class="flex mb-2 mr-2">
    <a class="btn btn-default rounded-r-none {{ !$year ? 'active' : '' }}" href="{{ UrlHelper::filter(['year' => null]) }}">Все</a>
    @foreach (range(date('Y'), 2009) as $value)
      <a
        class="btn btn-default -ml-px {{ $loop->last ? 'rounded-l-none rounded-r' : 'rounded-none' }} {{ $year == $value ? 'active' : '' }}"
        href="{{ UrlHelper::filter(['year' => $value]) }}"
      >{{ substr($value, 2) }}</a>
    @endforeach
  </div>
  <div class="flex mb-2">
    <a class="btn btn-default rounded-r-none {{ !$touch ? 'active' : '' }}" href="{{ UrlHelper::filter(['touch' => null]) }}">Все</a>
    @foreach (range(1, date('Y') - 2009) as $value)
      <a
        class="btn btn-default -ml-px {{ $loop->last ? 'rounded-l-none rounded-r' : 'rounded-none' }} {{ $touch == $value ? 'active' : '' }}"
        href="{{ UrlHelper::filter(['touch' => $value]) }}"
      >{{ $value }}</a>
    @endforeach
  </div>
</div>
@endsection

@section('content-list')
<table class="table-stats table-stats-align-top table-adaptive">
  <thead>
    <tr>
      <th><input class="border-gray-300 js-select-all" type="checkbox" data-selector=".models-checkbox"></th>
      <x-th-numeric-sortable key="id"/>
      <x-th key="user_id"/>
      <x-th key="slug"/>
      <x-th-numeric-sortable key="size"/>
      <x-th-numeric-sortable key="views">@svg (eye)</x-th-numeric-sortable>
      <x-th-numeric-sortable key="updated_at">@svg (eye-slash)</x-th-numeric-sortable>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($models as $model)
      <tr id="image_{{ $model->id }}">
        <td><input class="border-gray-300 models-checkbox" type="checkbox" name="ids[]" value="{{ $model->id }}"></td>
        <td class="md:text-right">{{ $model->id }}</td>
        <td class="md:text-right">
          <a href="{{ UrlHelper::filter(['user_id' => $model->user_id]) }}">
            {{ $model->user_id }}
          </a>
        </td>
        <td class="text-center">
          <a class="screenshot-link" href="{{ Acp::show($model) }}">
            <img class="inline-block screenshot" src="{{ $model->thumbnailSecretUrl() }}" alt="">
          </a>
        </td>
        <td class="md:text-right text-muted whitespace-nowrap">{{ ViewHelper::size($model->size) }}</td>
        <td class="md:text-right whitespace-nowrap">
          @if ($model->views > 3000)
            <span class="flex bg-greenish-600 text-white px-2 text-xs font-bold rounded">{{ ViewHelper::number($model->views) }}</span>
          @else
            {{ ViewHelper::number($model->views) }}
          @endif
        </td>
        <td>
          @if ($model->updated_at?->diffInMonths() > 6)
            {{ $model->updated_at->diffForHumans(null, true) }}
          @endif
        </td>
        <td>
          <div class="flex">
            <a class="btn btn-default rounded-r-none" href="{{ path([App\Http\Controllers\Acp\Images::class, 'view'], $model) }}">
              @svg (eye)
            </a>
            <a
              class="btn btn-default rounded-l-none -ml-px js-image-delete"
              data-confirm="{{ $model->views >= 3000 ? 'Запись будет удалена. Продолжить?' : '' }}"
              data-selector="#image_{{ $model->id }}"
              href="{{ path([App\Http\Controllers\Acp\Images::class, 'destroy'], $model) }}"
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
  @include('acp.tpl.batch', [
    'actions' => [
      'delete' => 'Удалить',
    ],
    'url' => path([App\Http\Controllers\Acp\Images::class, 'batch']),
  ])
</div>
@endsection

@push('js')
<script type="module">
document.addEventListener('click', (e) => {
  const target = e.target.closest('.js-image-delete')

  if (target === null) {
    return
  }

  e.preventDefault()

  const confirmText = target.dataset.confirm

  if (target.classList.contains('disabled')) {
    return false
  }

  if (confirmText) {
    if (!confirm(confirmText)) {
      return false
    }
  }

  target.classList.add('disabled')

  fetch(target.getAttribute('href'), {
    method: 'DELETE',
    headers: {
      'X-CSRF-TOKEN': window['AppOptions'].csrfToken,
      'X-Requested-With': 'XMLHttpRequest',
    },
  })
    .then(response => response.json())
    .then(json => {
      if (json.status === 'OK') {
        document.querySelector(target.dataset.selector).hidden = true
      } else {
        alert(json.message)
      }
    })

  return true
})
</script>
@endpush
