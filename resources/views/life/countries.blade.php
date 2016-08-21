@extends('life.base', [
  'meta_title' => trans('menu.countries'),
])

@section('content')
<h2>{{ trans('life.visited_countries') }}</h2>
<ul class="list-inline trips-show-by">
  <li><a class="link" href="{{ action('Life@index') }}">{{ trans('life.by_year') }}</a></li>
  <li><mark>{{ trans('life.by_country') }}</mark></li>
  <li><a class="link" href="{{ action('Life@cities') }}">{{ trans('life.by_city') }}</a></li>
</ul>

@if (!empty($countries))
  <ol>
    @foreach ($countries as $country)
      @php ($last_index = sizeof($country->cities) - 1)
      <li class="countries-list-country">
        <a class="link" href="{{ action('Life@country', $country->slug) }}"><strong>{{ $country->title }}</strong></a>:
        @foreach ($country->cities as $i => $city)
          <a class="link" href="{{ action('Life@page', $city->slug) }}">{{ $city->title }}</a>{{ $i !== $last_index ? ',' : '' }}
        @endforeach
      </li>
    @endforeach
  </ol>
@endif
@endsection
