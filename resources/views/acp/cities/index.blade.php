<?php /** @var \App\City $model */ ?>

@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th></th>
    <x-th-sortable key="title" defaultOrder="asc"/>
    <x-th key="slug"/>
    <x-th key="iata"/>
    <x-th-numeric-sortable key="trips_count"/>
    <x-th-numeric-sortable key="views">@svg (eye)</x-th-numeric-sortable>
    <th>@svg (map-marker)</th>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ Acp::edit($model) }}">
      <td class="tooltipped tooltipped-n" aria-label="{{ $model->country->title }}">
        <a href="{{ Acp::show($model->country) }}">
          <img class="block flag-16 svg-shadow" src="{{ $model->country->flagUrl() }}" alt="">
        </a>
      </td>
      <td><a href="{{ Acp::show($model) }}">{{ $model->title }}</a></td>
      <td><a href="{{ $model->www() }}">{{ $model->slug }}</a></td>
      <td class="text-muted">{{ $model->iata }}</td>
      <td class="md:text-right whitespace-nowrap">
        <a href="{{ Acp::index(new App\Trip, $model) }}">
          {{ ViewHelper::number($model->trips_count) ?: '' }}
        </a>
      </td>
      <td class="md:text-right whitespace-nowrap">
        {{ ViewHelper::number($model->views) ?: '' }}
      </td>
      <td class="tooltipped tooltipped-n text-red-600" aria-label="Геолокация не задана">
        @if ($model->isNotOnMap())
          @svg (issue-opened)
        @endif
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
