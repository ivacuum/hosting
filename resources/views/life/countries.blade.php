@extends('life.base', [
  'metaTitle' => trans('menu.countries'),
])

@section('content')
<h1 class="text-3xl">
  {{ trans('life.visited_countries') }}
  <span class="text-base text-muted">{{ sizeof($countries) }}</span>
</h1>
<nav class="flex flex-wrap text-sm mb-4">
  <div class="mr-3 whitespace-no-wrap"><a class="link" href="{{ path([App\Http\Controllers\Life::class, 'index']) }}">{{ trans('life.by_year') }}</a></div>
  <div class="mr-3 whitespace-no-wrap"><mark>{{ trans('life.by_country') }}</mark></div>
  <div class="mr-3 whitespace-no-wrap"><a class="link" href="{{ path([App\Http\Controllers\Life::class, 'cities']) }}">{{ trans('life.by_city') }}</a></div>
  <div class="whitespace-no-wrap"><a class="link" href="{{ path([App\Http\Controllers\Life::class, 'calendar']) }}">{{ trans('life.by_days') }}</a></div>
</nav>

@if ($countries->count())
  <ol class="pl-8">
    @foreach ($countries as $country)
      <li class="{{ !$loop->last ? 'mb-2' : '' }}">
        @if ($country->trips_published_count)
          <a class="link" href="{{ $country->www() }}"><strong>{{ $country->title }}</strong></a>:
        @else
          <strong>{{ $country->title }}</strong>:
        @endif
        @foreach ($country->cities as $city)
          @if ($city->trips_published_count)
            <a class="link" href="{{ $city->www() }}">{{ $city->title }}</a>{{ !$loop->last ? ',' : '' }}
          @else
            {{ $city->title }}{{ !$loop->last ? ',' : '' }}
          @endif
        @endforeach
      </li>
    @endforeach
  </ol>
@endif
@endsection
