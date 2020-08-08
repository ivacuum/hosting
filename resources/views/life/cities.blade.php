@extends('life.base')

@section('content')
<h1 class="text-3xl">
  {{ trans('life.visited_cities') }}
  <span class="text-base text-muted">{{ sizeof($cities) }}</span>
</h1>
<nav class="flex flex-wrap text-sm mb-4">
  <div class="mr-3 whitespace-no-wrap"><a class="link" href="{{ path([App\Http\Controllers\Life::class, 'index']) }}">{{ trans('life.by_year') }}</a></div>
  <div class="mr-3 whitespace-no-wrap"><a class="link" href="{{ path([App\Http\Controllers\Life::class, 'countries']) }}">{{ trans('life.by_country') }}</a></div>
  <div class="mr-3 whitespace-no-wrap"><mark>{{ trans('life.by_city') }}</mark></div>
  <div class="whitespace-no-wrap"><a class="link" href="{{ path(App\Http\Controllers\CalendarController::class) }}">{{ trans('life.by_days') }}</a></div>
</nav>

<div class="column-width-48">
  <?php $initial = $currentInitial = null ?>
  <?php /** @var App\City $city */ ?>
  @foreach ($cities as $city)
    <?php $currentInitial = $city->initial() ?>
    <div class="city-entry relative ml-6 pb-2">
      @if ($initial !== $currentInitial)
        <span class="absolute font-bold uppercase -ml-6">{{ $currentInitial }}</span>
      @endif
      @if ($city->trips_published_count)
        <a class="link" href="{{ $city->www() }}">{{ $city->title }}</a>
      @else
        {{ $city->title }}
      @endif
      @if ($city->trips_count > 1)
        <span class="text-xs text-muted">{{ $city->trips_count }}</span>
      @endif
    </div>
    <?php $initial = $currentInitial ?>
  @endforeach
</div>
@endsection
