@if ($city->isOnMap())
  <button class="btn btn-default js-city-map-click"
          data-container="{{ $container ?? 'trip_city_map' }}"
          data-action="{{ action('Photos@map', ['trip_id' => $trip->id]) }}"
          data-lat="{{ $city->lat }}"
          data-lon="{{ $city->lon }}">
    @svg (map-marker)
    {{ trans('life.on_map') }}
  </button>
@endif
