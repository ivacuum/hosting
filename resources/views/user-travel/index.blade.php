@extends('user-travel.base', [
  'metaTitle' => __('Заметки'),
])

@section('content')
<section class="pt-0">
  <div class="flex flex-wrap items-center">
    <h1 class="h2 mr-4">
      @lang('Поездки')
    </h1>
    @if ($traveler->id == optional(auth()->user())->id)
      <a class="btn btn-success text-sm py-1" href="{{ path([App\Http\Controllers\MyTrips::class, 'create']) }}">
        {{ trans('acp.trips.create') }}
      </a>
    @endif
  </div>
  <nav class="flex flex-wrap text-sm mb-4">
    <div class="mr-3 whitespace-no-wrap"><mark>{{ trans('life.by_year') }}</mark></div>
    <div class="mr-3 whitespace-no-wrap"><a class="link" href="{{ path([App\Http\Controllers\UserTravelCountries::class, 'index'], $traveler->login) }}">{{ trans('life.by_country') }}</a></div>
    <div class="whitespace-no-wrap"><a class="link" href="{{ path([App\Http\Controllers\UserTravelCities::class, 'index'], $traveler->login) }}">{{ trans('life.by_city') }}</a></div>
  </nav>

  @include('tpl.trips_by_years')
</section>
@endsection
