@extends('user-travel.base', [
  'meta_title' => $city->title,
])

@section('content')
<div hidden id="trip_city_map" class="trip-city-map"></div>
<h1 class="h2 mt-0">
  {{ $city->country->emoji }}
  {{ $city->title }}
  @include('tpl.city-map-button')
</h1>
@include('tpl.trips_by_years')
@endsection
