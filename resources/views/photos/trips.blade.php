<?php
/** @var App\Trip $trip */
?>

@extends('photos.base')

@section('content')
<div class="flex flex-wrap mobile-wide">
  @foreach ($trips as $trip)
    <?php $trip->loadCityAndCountry(); ?>
    <div class="w-full sm:w-1/2 lg:w-1/3 mx-auto sm:mx-0 relative">
      <a class="block group" href="{{ $trip->www() }}">
        <div class="relative pb-3/4">
          <img
            class="absolute w-full h-full object-cover brightness-3/4 group-hover:brightness-full"
            src="{{ $trip->metaImage(500, 375) }}"
          >
        </div>
        <div class="absolute bottom-0 left-0 text-white trip-cover-info p-4">
          <div class="text-lg">
            <img class="flag-24 svg-shadow" src="{{ $trip->city->country->flagUrl() }}">
            {{ $trip->title }}
            <span class="text-gray-400 text-xs">{{ $trip->timelinePeriod(true) }}</span>
          </div>
          <div class="text-xs md:text-sm">{{ $trip->metaDescription() }}</div>
        </div>
      </a>
    </div>
  @endforeach
</div>
@endsection
