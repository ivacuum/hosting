@extends('life.base', [
  'meta_title' => trans('menu.countries'),
])

@section('content')
<h2>
  {{ trans('life.visited_countries') }}
  <small>{{ sizeof($countries) }}</small>
</h2>
<ul class="list-inline trips-show-by">
  <li><a class="link" href="{{ action('Life@index') }}">{{ trans('life.by_year') }}</a></li>
  <li><mark>{{ trans('life.by_country') }}</mark></li>
  <li><a class="link" href="{{ action('Life@cities') }}">{{ trans('life.by_city') }}</a></li>
</ul>

@if (!empty($countries))
  <ol>
    @foreach ($countries as $country)
      @continue ($country->trips_count === 0)
      <li class="countries-list-country">
        @if ($country->trips_published_count)
          <a class="link" href="{{ action('Life@country', $country->slug) }}">
            <strong>{{ $country->title }}</strong>
          </a>:
        @else
          <strong>{{ $country->title }}</strong>:
        @endif
        @foreach ($country->cities as $i => $city)
          @continue ($city->trips_count === 0)
          @if ($city->trips_published_count)
            <a class="link" href="{{ action('Life@page', $city->slug) }}">{{ $city->title }}</a>{{ !$loop->last ? ',' : '' }}
          @else
            {{ $city->title }}{{ !$loop->last ? ',' : '' }}
          @endif
        @endforeach
      </li>
    @endforeach
  </ol>
@endif
@endsection
