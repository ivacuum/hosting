@extends('life.base')

@section('content')
<div id="trip_city_map" class="mb-4 hidden mobile-wide h-[50vh]"></div>
<div class="flex flex-wrap items-center mb-4">
  <img class="flag-24 svg-shadow mr-2" src="{{ $city->country->flagUrl() }}" alt="">
  <h1 class="h2 tracking-tight mb-1 mr-2">{{ $city->title }}</h1>
  @include('tpl.city-map-button')
</div>
@include('tpl.trips_by_years')
@endsection
