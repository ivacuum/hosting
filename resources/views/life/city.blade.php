@extends('life.base', [
  'meta_title' => $city->metaTitle(),
  'meta_description' => $city->metaDescription($trips),
])

@section('content')
<div id="trip_city_map" class="mb-4 hidden mobile-wide h-1/2-screen"></div>
<div class="flex flex-wrap items-center mb-4">
  <img class="flag-24 svg-shadow mr-2" src="{{ $city->country->flagUrl() }}" alt="">
  <h1 class="h2 mb-1 mr-2">{{ $city->title }}</h1>
  @include('tpl.city-map-button')
</div>
@include('tpl.trips_by_years')
{{--
@if ($city->iata)
  @include('tpl.tickets_calendar', ['origin' => 'MOW', 'destination' => $city->iata])
@endif
--}}
@endsection
