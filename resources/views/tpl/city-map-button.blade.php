@if ($city->isOnMap())
  <button
    class="btn btn-default text-sm mr-1 py-1 js-city-map-click"
    data-container="{{ $container ?? 'trip_city_map' }}"
    data-action="{{ isset($trip) ? path('Photos@map', ['trip_id' => $trip->id]) : '' }}"
    data-lat="{{ $city->lat }}"
    data-lon="{{ $city->lon }}"
  >
    @svg (map-marker)
    {{ trans('life.on_map') }}
  </button>
@endif
