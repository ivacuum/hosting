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
        <div class="absolute bottom-0 left-0 text-white trip-cover-info p-4 w-full">
          <div class="flex flex-wrap items-center text-lg">
            <img class="flag-24 mr-1 svg-shadow" src="{{ $trip->city->country->flagUrl() }}" alt="">
            <span class="leading-none mr-1">{{ $trip->title }}</span>
            <span class="leading-tight self-end text-gray-300 text-xs">{{ $trip->timelinePeriod(true) }}</span>
          </div>
          @if ($trip->metaDescription())
            <div class="leading-tight mt-1 text-xs md:text-2sm">{{ $trip->metaDescription() }}</div>
          @endif
        </div>
      </a>
    </div>
  @endforeach
</div>
@endsection
