<?php
/** @var \App\Country $model */
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
    <th class="md:text-right whitespace-no-wrap">
      @include('acp.tpl.sortable-header', ['key' => 'cities_count'])
    </th>
    <th class="md:text-right whitespace-no-wrap">
      @include('acp.tpl.sortable-header', ['key' => 'trips_count'])
    </th>
    <th class="md:text-right whitespace-no-wrap">
      @include('acp.tpl.sortable-header', ['key' => 'views', 'svg' => 'eye'])
    </th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ UrlHelper::edit($controller, $model) }}">
      <td><img class="block flag-16 svg-shadow" src="{{ $model->flagUrl() }}" alt=""></td>
      <td><a href="{{ $model->wwwAcp() }}">{{ $model->title }}</a></td>
      <td><a href="{{ $model->www() }}">{{ $model->slug }}</a></td>
      <td class="md:text-right whitespace-no-wrap">
        <a href="{{ $model->wwwAcpCities() }}">
          {{ ViewHelper::number($model->cities_count) ?: '' }}
        </a>
      </td>
      <td class="md:text-right whitespace-no-wrap">
        <a href="{{ $model->wwwAcpTrips() }}">
          {{ ViewHelper::number($model->trips_count) ?: '' }}
        </a>
      </td>
      <td class="md:text-right whitespace-no-wrap">
        {{ ViewHelper::number($model->views) ?: '' }}
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
