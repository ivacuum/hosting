@extends('life.base', [
  'meta_title' => trans('menu.cities'),
])

@section('content')
<h1 class="tw-text-3xl">
  {{ trans('life.visited_cities') }}
  <span class="tw-text-base text-muted">{{ sizeof($cities) }}</span>
</h1>
<ul class="list-inline tw-text-sm">
  <li class="list-inline-item tw-whitespace-no-wrap"><a class="link" href="{{ path('Life@index') }}">{{ trans('life.by_year') }}</a></li>
  <li class="list-inline-item tw-whitespace-no-wrap"><a class="link" href="{{ path('Life@countries') }}">{{ trans('life.by_country') }}</a></li>
  <li class="list-inline-item tw-whitespace-no-wrap"><mark>{{ trans('life.by_city') }}</mark></li>
  <li class="list-inline-item tw-whitespace-no-wrap"><a class="link" href="{{ path('Life@calendar') }}">{{ trans('life.by_days') }}</a></li>
</ul>

<div class="cities-columns">
  @php ($initial = $current_initial = false)
  @foreach ($cities as $city)
    @php ($current_initial = $city->initial())
    <div class="city-entry tw-relative tw-ml-6 tw-pb-2">
      @if ($initial !== $current_initial)
        <span class="tw-absolute tw-font-bold tw-uppercase tw--ml-6">{{ $current_initial }}</span>
      @endif
      @if ($city->trips_published_count)
        <a class="link" href="{{ $city->www() }}">{{ $city->title }}</a>
      @else
        {{ $city->title }}
      @endif
      @if ($city->trips_count > 1)
        <span class="tw-text-xs text-muted">{{ $city->trips_count }}</span>
      @endif
    </div>
    @php ($initial = $current_initial)
  @endforeach
</div>
@endsection
