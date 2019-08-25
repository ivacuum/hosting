@extends('user-travel.base', [
  'meta_title' => trans('menu.life'),
])

@section('content')
<section class="pt-0">
  <h1 class="h2">
    {{ trans('life.trips') }}
    @if ($traveler->id == optional(auth()->user())->id)
      <a class="btn btn-success" href="{{ path('MyTrips@create') }}">
        {{ trans('acp.trips.create') }}
      </a>
    @endif
  </h1>
  <ul class="list-inline text-sm">
    <li class="list-inline-item"><mark>{{ trans('life.by_year') }}</mark></li>
    <li class="list-inline-item"><a class="link" href="{{ path('UserTravelCountries@index', $traveler->login) }}">{{ trans('life.by_country') }}</a></li>
    <li class="list-inline-item"><a class="link" href="{{ path('UserTravelCities@index', $traveler->login) }}">{{ trans('life.by_city') }}</a></li>
  </ul>

  @include('tpl.trips_by_years')
</section>
@endsection
