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
        <div class="tw-relative tw-w-full tw-pb-3/4">
          <img class="tw-absolute tw-top-0 tw-left-0 tw-w-full tw-object-cover tw-brightness-3/4 group-hover:tw-brightness-full" src="{{ $trip->metaImage(500, 375) }}">
        </div>
        <div class="trip-cover-info tw-p-4">
          <div class="tw-text-lg">
            <img class="flag-24 flag-shadow" src="{{ $trip->city->country->flagUrl() }}">
            <span class="group-hover:tw-text-gray-100">{{ $trip->title }}</span>
            <span class="trip-cover-date">{{ $trip->timelinePeriod(true) }}</span>
          </div>
          <div class="trip-cover-description">{{ $trip->metaDescription() }}</div>
        </div>
      </a>
    </div>
  @endforeach
</div>
@endsection
