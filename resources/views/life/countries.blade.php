@extends('life.base', [
  'meta_title' => trans('menu.countries'),
])

@section('content')
<h1 class="tw-text-3xl">
  {{ trans('life.visited_countries') }}
  <small class="text-muted">{{ sizeof($countries) }}</small>
</h1>
<ul class="list-inline tw-text-sm">
  <li class="list-inline-item tw-whitespace-no-wrap"><a class="link" href="{{ path('Life@index') }}">{{ trans('life.by_year') }}</a></li>
  <li class="list-inline-item tw-whitespace-no-wrap"><mark>{{ trans('life.by_country') }}</mark></li>
  <li class="list-inline-item tw-whitespace-no-wrap"><a class="link" href="{{ path('Life@cities') }}">{{ trans('life.by_city') }}</a></li>
  <li class="list-inline-item tw-whitespace-no-wrap"><a class="link" href="{{ path('Life@calendar') }}">{{ trans('life.by_days') }}</a></li>
</ul>

@if ($countries->count())
  <ol class="tw-mb-0">
    @foreach ($countries as $country)
      <li class="{{ !$loop->last ? 'tw-mb-2' : '' }}">
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
