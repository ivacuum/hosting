@extends('life.base', [
  'meta_title' => $city->metaTitle(),
  'meta_description' => $city->metaDescription($trips),
])

@section('content')
<div id="trip_city_map" class="trip-city-map mb-3" style="display: none;"></div>
<div class="row">
  <div class="col-sm-6">
    <div class="d-flex flex-wrap align-items-center mb-3">
      <img class="flag-24 flag-shadow mr-2" src="{{ $city->country->flagUrl() }}">
      <h1 class="h2 mb-1 mr-2">{{ $city->title }}</h1>
      @include('tpl.city-map-button')
    </div>
    @include('tpl.trips_by_years')
  </div>
  {{--
  <div class="col-sm-6">
    @if ($city->iata)
      @include('tpl.tickets_calendar', ['origin' => 'MOW', 'destination' => $city->iata])
    @endif
  </div>
  --}}
</div>
@endsection
