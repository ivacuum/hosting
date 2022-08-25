@extends('life.base')

@section('content')
<h1 class="text-3xl mb-2">
  <span class="font-medium tracking-tight">@lang('Посещенные города')</span>
  <span class="text-base text-muted">{{ count($cities) }}</span>
</h1>
<x-trips-subnav/>

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
