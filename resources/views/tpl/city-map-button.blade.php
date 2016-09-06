@if ($city->isOnMap())
  <button class="btn btn-default js-city-map-click" data-container="{{ $container or 'trip_city_map' }}" data-lat="{{ $city->lat }}" data-lon="{{ $city->lon }}">
    @php (require base_path('resources/svg/map-marker.html'))
    {{ trans('life.on_map') }}
  </button>
@endif
