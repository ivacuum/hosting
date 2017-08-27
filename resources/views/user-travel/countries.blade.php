@extends('user-travel.base', [
  'meta_title' => trans('menu.countries'),
])

@section('content')
<h1 class="h2 mt-0">
  {{ trans('life.visited_countries') }}
  <small>{{ sizeof($countries) }}</small>
</h1>
<ul class="list-inline f14">
  <li><a class="link" href="{{ path('UserTravelTrips@index', $traveler->login) }}">{{ trans('life.by_year') }}</a></li>
  <li><mark>{{ trans('life.by_country') }}</mark></li>
  <li><a class="link" href="{{ path('UserTravelCities@index', $traveler->login) }}">{{ trans('life.by_city') }}</a></li>
</ul>

@if (!empty($countries))
  <ol>
    @foreach ($countries as $country)
      @continue ($country->trips_count === 0)
      <li class="mb-2">
        @if ($country->trips_published_count)
          <a class="link" href="{{ path('UserTravelCountries@show', [$traveler->login, $country->slug]) }}"><strong>{{ $country->title }}</strong></a>:
        @else
          <strong>{{ $country->title }}</strong>:
        @endif
        @foreach ($country->filtered_cities as $city)
          @if ($city->trips_published_count)
            <a class="link" href="{{ path('UserTravelCities@show', [$traveler->login, $city->slug]) }}">{{ $city->title }}</a>{{ !$loop->last ? ',' : '' }}
          @else
            {{ $city->title }}{{ !$loop->last ? ',' : '' }}
          @endif
        @endforeach
      </li>
    @endforeach
  </ol>
@endif
@endsection
