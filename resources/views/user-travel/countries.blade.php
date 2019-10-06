@extends('user-travel.base', [
  'metaTitle' => trans('menu.countries'),
])

@section('content')
<h1 class="h2">
  {{ trans('life.visited_countries') }}
  <span class="text-base text-muted">{{ sizeof($countries) }}</span>
</h1>
<nav class="flex flex-wrap text-sm mb-4">
  <div class="mr-3 whitespace-no-wrap"><a class="link" href="{{ path([App\Http\Controllers\UserTravelTrips::class, 'index'], $traveler->login) }}">{{ trans('life.by_year') }}</a></div>
  <div class="mr-3 whitespace-no-wrap"><mark>{{ trans('life.by_country') }}</mark></div>
  <div class="whitespace-no-wrap"><a class="link" href="{{ path([App\Http\Controllers\UserTravelCities::class, 'index'], $traveler->login) }}">{{ trans('life.by_city') }}</a></div>
</nav>

@if ($countries->count())
  <ol class="pl-8">
    @foreach ($countries as $country)
      @continue ($country->trips_count === 0)
      <li class="{{ !$loop->last ? 'mb-2' : '' }}">
        @if ($country->trips_published_count)
          <a class="link" href="{{ path([App\Http\Controllers\UserTravelCountries::class, 'show'], [$traveler->login, $country->slug]) }}"><strong>{{ $country->title }}</strong></a>:
        @else
          <strong>{{ $country->title }}</strong>:
        @endif
        @foreach ($country->cities as $city)
          @if ($city->trips_published_count)
            <a class="link" href="{{ path([App\Http\Controllers\UserTravelCities::class, 'show'], [$traveler->login, $city->slug]) }}">{{ $city->title }}</a>{{ !$loop->last ? ',' : '' }}
          @else
            {{ $city->title }}{{ !$loop->last ? ',' : '' }}
          @endif
        @endforeach
      </li>
    @endforeach
  </ol>
@endif
@endsection
