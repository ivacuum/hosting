<?php
/** @var App\Trip $trip */
?>

@extends('photos.base')

@section('content')
<div class="tw-flex tw-flex-wrap tw-mobile-wide">
  @foreach ($trips as $trip)
    <?php $trip->loadCityAndCountry(); ?>
    <div class="tw-w-full sm:tw-w-1/2 lg:tw-w-1/3 tw-mx-auto sm:tw-mx-0 tw-relative">
      <a class="tw-block group" href="{{ $trip->www() }}">
        <div class="tw-relative tw-pb-3/4">
          <img
            class="tw-absolute tw-w-full tw-h-full tw-object-cover brightness-3/4 group-hover:brightness-full"
            src="{{ $trip->metaImage(500, 375) }}"
          >
        </div>
        <div class="tw-absolute tw-bottom-0 tw-left-0 tw-text-white trip-cover-info tw-p-4">
          <div class="tw-text-lg">
            <img class="flag-24 flag-shadow" src="{{ $trip->city->country->flagUrl() }}">
            {{ $trip->title }}
            <span class="tw-text-gray-400 tw-text-xs">{{ $trip->timelinePeriod(true) }}</span>
          </div>
          <div class="tw-text-xs md:tw-text-sm">{{ $trip->metaDescription() }}</div>
        </div>
      </a>
    </div>
  @endforeach
</div>
@endsection
