<?php
/**
 * @var \App\Domain\Life\Models\City $city
 * @var \App\Domain\Life\Models\Trip $trip
 */
?>

@if ($city->isOnMap())
  <button
    class="btn btn-default text-sm lowercase py-1 js-city-map-click"
    data-container="{{ $container ?? 'trip_city_map' }}"
    data-action="{{ isset($trip) ? to('photos/map', ['trip_id' => $trip->id]) : '' }}"
    data-lat="{{ $city->point->lat }}"
    data-lon="{{ $city->point->lon }}"
  >
    @svg (map-marker)
    @lang('На карте')
  </button>
@endif
