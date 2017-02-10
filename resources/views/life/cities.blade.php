@extends('life.base', [
  'meta_title' => trans('menu.cities'),
])

@section('content')
<h2 class="mt-0">
  {{ trans('life.visited_cities') }}
  <small>{{ sizeof($cities) }}</small>
</h2>
<ul class="list-inline f13">
  <li><a class="link" href="{{ action('Life@index') }}">{{ trans('life.by_year') }}</a></li>
  <li><a class="link" href="{{ action('Life@countries') }}">{{ trans('life.by_country') }}</a></li>
  <li><mark>{{ trans('life.by_city') }}</mark></li>
</ul>

<div class="cities-columns">
  @php ($initial = $current_initial = false)
  @foreach ($cities as $city)
    @php ($current_initial = $city->getInitial())
    <div class="city-entry pb-2">
      @if ($initial !== $current_initial)
        <span class="city-initial">{{ $current_initial }}</span>
      @endif
      @if ($city->trips_published_count)
        <a class="link" href="{{ action('Life@page', $city->slug) }}">{{ $city->title }}</a>
      @else
        {{ $city->title }}
      @endif
      @if ($city->trips_count > 1)
        <span class="city-trips">{{ $city->trips_count }}</span>
      @endif
    </div>
    @php ($initial = $current_initial)
  @endforeach
</div>
@endsection
