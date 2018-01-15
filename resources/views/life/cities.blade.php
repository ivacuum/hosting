@extends('life.base', [
  'meta_title' => trans('menu.cities'),
])

@section('content')
<h1 class="h2">
  {{ trans('life.visited_cities') }}
  <small class="text-muted">{{ sizeof($cities) }}</small>
</h1>
<ul class="list-inline f14">
  <li class="list-inline-item"><a class="link" href="{{ path('Life@index') }}">{{ trans('life.by_year') }}</a></li>
  <li class="list-inline-item"><a class="link" href="{{ path('Life@countries') }}">{{ trans('life.by_country') }}</a></li>
  <li class="list-inline-item"><mark>{{ trans('life.by_city') }}</mark></li>
</ul>

<div class="cities-columns">
  @php ($initial = $current_initial = false)
  @foreach ($cities as $city)
    @php ($current_initial = $city->initial())
    <div class="city-entry pb-2">
      @if ($initial !== $current_initial)
        <span class="city-initial">{{ $current_initial }}</span>
      @endif
      @if ($city->trips_published_count)
        <a class="link" href="{{ $city->www() }}">{{ $city->title }}</a>
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
