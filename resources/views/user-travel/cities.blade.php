@extends('user-travel.base', [
  'meta_title' => trans('menu.cities'),
])

@section('content')
<h1 class="h2">
  {{ trans('life.visited_cities') }}
  <span class="text-base text-muted">{{ sizeof($cities) }}</span>
</h1>
<ul class="list-inline text-sm">
  <li class="list-inline-item"><a class="link" href="{{ path('UserTravelTrips@index', $traveler->login) }}">{{ trans('life.by_year') }}</a></li>
  <li class="list-inline-item"><a class="link" href="{{ path('UserTravelCountries@index', $traveler->login) }}">{{ trans('life.by_country') }}</a></li>
  <li class="list-inline-item"><mark>{{ trans('life.by_city') }}</mark></li>
</ul>

<div class="cities-columns">
  @php ($initial = $current_initial = false)
  @foreach ($cities as $city)
    @php ($current_initial = $city->initial())
    <div class="city-entry relative ml-6 pb-2">
      @if ($initial !== $current_initial)
        <span class="absolute font-bold uppercase -ml-6">{{ $current_initial }}</span>
      @endif
      @if ($city->trips_published_count)
        <a class="link" href="{{ path('UserTravelCities@show', [$traveler->login, $city->slug]) }}">{{ $city->title }}</a>
      @else
        {{ $city->title }}
      @endif
      @if ($city->trips_count > 1)
        <span class="text-xs text-muted">{{ $city->trips_count }}</span>
      @endif
    </div>
    @php ($initial = $current_initial)
  @endforeach
</div>
@endsection
