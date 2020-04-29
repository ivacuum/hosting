<?php
/** @var \App\City $model */
?>

@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th></th>
    <th>
      @include('acp.tpl.sortable-header', ['key' => 'title'])
    </th>
    <th>{{ ViewHelper::modelFieldTrans($modelTpl, 'slug') }}</th>
    <th>{{ ViewHelper::modelFieldTrans($modelTpl, 'iata') }}</th>
    <th class="md:text-right whitespace-no-wrap">
      @include('acp.tpl.sortable-header', ['key' => 'trips_count'])
    </th>
    <th class="md:text-right whitespace-no-wrap">
      @include('acp.tpl.sortable-header', ['key' => 'views', 'svg' => 'eye'])
    </th>
    <th></th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($controller, $model) }}">
      <td class="tooltipped tooltipped-n" aria-label="{{ $model->country->title }}">
        <a href="{{ $model->country->wwwAcp() }}">
          <img class="block flag-16 svg-shadow" src="{{ $model->country->flagUrl() }}" alt="">
        </a>
      </td>
      <td><a href="{{ $model->wwwAcp() }}">{{ $model->title }}</a></td>
      <td><a href="{{ $model->www() }}">{{ $model->slug }}</a></td>
      <td class="text-muted">{{ $model->iata }}</td>
      <td class="md:text-right whitespace-no-wrap">
        <a href="{{ $model->wwwAcpPhotos() }}">
          {{ ViewHelper::number($model->trips_count) }}
        </a>
      </td>
      <td class="md:text-right whitespace-no-wrap">
        {{ ViewHelper::number($model->views) ?: '' }}
      </td>
      <td class="tooltipped tooltipped-n" aria-label="Геолокация задана">
        @if ($model->isOnMap())
          @svg (map-marker)
        @endif
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
