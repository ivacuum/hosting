@extends('user-travel.base', [
  'meta_title' => $city->title,
])

@section('content')
<div id="trip_city_map" class="trip-city-map mb-3" style="display: none;"></div>
<div class="d-flex flex-wrap align-items-center mb-3">
  <h1 class="h2 mb-1 mr-2">
    {{ $city->country->emoji }}
    {{ $city->title }}
  </h1>
  @include('tpl.city-map-button')
</div>
@include('tpl.trips_by_years')
@endsection
