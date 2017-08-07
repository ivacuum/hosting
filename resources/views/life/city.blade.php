@extends('life.base', [
  'meta_title' => $city->title,
])

@section('content')
<div hidden id="trip_city_map" class="trip-city-map"></div>
<div class="row">
  <div class="col-sm-6">
    <h1 class="h2 mt-0">
      {{ $city->country->emoji }}
      {{ $city->title }}
      @include('tpl.city-map-button')
    </h1>
    @include('tpl.trips_by_years')
  </div>
  <div class="col-sm-6">
    @if ($city->iata)
      @include('tpl.tickets_calendar', ['origin' => 'MOW', 'destination' => $city->iata])
    @endif
  </div>
</div>
@endsection
