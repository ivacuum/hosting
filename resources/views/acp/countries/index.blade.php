<?php /** @var \App\Country $model */ ?>

@extends('acp.list')

@section('content-list')
<table class="table-stats table-adaptive">
  <thead>
  <tr>
    <th></th>
    <x-th-sortable key="title" defaultOrder="asc"/>
    <x-th key="slug"/>
    <x-th-numeric-sortable key="cities_count"/>
    <x-th-numeric-sortable key="trips_count"/>
    <x-th-numeric-sortable key="views">@svg (eye)</x-th-numeric-sortable>
  </tr>
  </thead>
  <tbody>
  @foreach ($models as $model)
    <tr class="js-dblclick-edit" data-dblclick-url="{{ Acp::edit($model) }}">
      <td><img class="block flag-16 svg-shadow" src="{{ $model->flagUrl() }}" alt=""></td>
      <td><a href="{{ Acp::show($model) }}">{{ $model->title }}</a></td>
      <td><a href="{{ $model->www() }}">{{ $model->slug }}</a></td>
      <td class="md:text-right whitespace-nowrap">
        <a href="{{ Acp::index(new App\City, $model) }}">
          {{ ViewHelper::number($model->cities_count) ?: '' }}
        </a>
      </td>
      <td class="md:text-right whitespace-nowrap">
        <a href="{{ Acp::index(new App\Trip, $model) }}">
          {{ ViewHelper::number($model->trips_count) ?: '' }}
        </a>
      </td>
      <td class="md:text-right whitespace-nowrap">
        {{ ViewHelper::number($model->views) ?: '' }}
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
@endsection
