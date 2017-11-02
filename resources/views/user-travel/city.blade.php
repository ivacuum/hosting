@extends('user-travel.base', [
  'meta_title' => $city->title,
])

@section('content')
<div hidden id="trip_city_map" class="trip-city-map"></div>
<div class="d-flex flex-wrap align-items-center mb-3">
  <h1 class="h2 mt-0 mb-1 mr-2">
    {{ $city->country->emoji }}
    {{ $city->title }}
  </h1>
  @include('tpl.city-map-button')
</div>
@include('tpl.trips_by_years')
@endsection
