@extends('user-travel.base', [
  'meta_title' => $city->title,
  'meta_description' => $city->metaDescription($trips),
])

@section('content')
<div id="trip_city_map" class="tw-mb-4 tw-hidden tw-mobile-wide tw-h-1/2-screen"></div>
<div class="tw-flex tw-flex-wrap tw-items-center tw-mb-4">
  <img class="flag-24 svg-shadow tw-mr-2" src="{{ $city->country->flagUrl() }}">
  <h1 class="h2 tw-mb-1 tw-mr-2">{{ $city->title }}</h1>
  @include('tpl.city-map-button')
</div>
@include('tpl.trips_by_years')
@endsection
