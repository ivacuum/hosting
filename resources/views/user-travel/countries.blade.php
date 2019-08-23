@extends('user-travel.base', [
  'meta_title' => trans('menu.countries'),
])

@section('content')
<h1 class="h2">
  {{ trans('life.visited_countries') }}
  <span class="tw-text-base text-muted">{{ sizeof($countries) }}</span>
</h1>
<ul class="list-inline tw-text-sm">
  <li class="list-inline-item"><a class="link" href="{{ path('UserTravelTrips@index', $traveler->login) }}">{{ trans('life.by_year') }}</a></li>
  <li class="list-inline-item"><mark>{{ trans('life.by_country') }}</mark></li>
  <li class="list-inline-item"><a class="link" href="{{ path('UserTravelCities@index', $traveler->login) }}">{{ trans('life.by_city') }}</a></li>
</ul>

@if ($countries->count())
  <ol class="tw-mb-0">
    @foreach ($countries as $country)
      @continue ($country->trips_count === 0)
      <li class="{{ !$loop->last ? 'tw-mb-2' : '' }}">
        @if ($country->trips_published_count)
          <a class="link" href="{{ path('UserTravelCountries@show', [$traveler->login, $country->slug]) }}"><strong>{{ $country->title }}</strong></a>:
        @else
          <strong>{{ $country->title }}</strong>:
        @endif
        @foreach ($country->cities as $city)
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
