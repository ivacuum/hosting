<?php /** @var App\City $city */ ?>

@extends('user-travel.base', [
  'metaTitle' => $city->title,
  'metaDescription' => $city->metaDescription($modelsByYears),
])

@section('content')
<div id="trip_city_map" class="mb-4 hidden -mx-4 sm:mx-0 h-[50vh]"></div>
<div class="flex flex-wrap gap-2 items-center mb-4">
  <img class="flag-24 svg-shadow" src="{{ $city->country->flagUrl() }}" alt="">
  <h1 class="font-medium text-3xl tracking-tight mb-1">{{ $city->title }}</h1>
  @include('tpl.city-map-button')
</div>
@include('tpl.trips_by_years')
@endsection
