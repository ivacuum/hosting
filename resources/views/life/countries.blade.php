@extends('life.base', [
  'meta_title' => trans('menu.countries'),
])

@section('content')
<h1 class="h2 mt-0">
  {{ trans('life.visited_countries') }}
  <small>{{ sizeof($countries) }}</small>
</h1>
<ul class="list-inline f14">
  <li><a class="link" href="{{ path('Life@index') }}">{{ trans('life.by_year') }}</a></li>
  <li><mark>{{ trans('life.by_country') }}</mark></li>
  <li><a class="link" href="{{ path('Life@cities') }}">{{ trans('life.by_city') }}</a></li>
</ul>

@if (!empty($countries))
  <ol>
    @foreach ($countries as $country)
      @continue ($country->trips_count === 0)
      <li class="mb-2">
        @if ($country->trips_published_count)
          <a class="link" href="{{ $country->www() }}"><strong>{{ $country->title }}</strong></a>:
        @else
          <strong>{{ $country->title }}</strong>:
        @endif
        @foreach ($country->cities as $city)
          @continue ($city->trips_count === 0)
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
