<?php
/** @var App\Trip $trip */
?>

@extends('photos.base')

@section('content')
<div class="tw-flex tw-flex-wrap tw-mobile-wide">
  @foreach ($trips as $trip)
    <?php $trip->loadCityAndCountry(); ?>
    <div class="tw-w-full sm:tw-w-1/2 lg:tw-w-1/3 tw-mx-auto sm:tw-mx-0 tw-relative">
      <a class="tw-block" href="{{ $trip->www() }}">
        <div class="hover-opacity-85 image-tint">
          <img class="image-fit-cover image-sm-4x3-2col image-lg-4x3-3col" src="{{ $trip->metaImage(500, 375) }}">
        </div>
        <div class="trip-cover-info tw-p-4">
          <div class="f18">
            <img class="flag-24 flag-shadow" src="{{ $trip->city->country->flagUrl() }}">
            {{ $trip->title }}
            <span class="trip-cover-date">{{ $trip->timelinePeriod(true) }}</span>
          </div>
          <div class="trip-cover-description">{{ $trip->metaDescription() }}</div>
        </div>
      </a>
    </div>
  @endforeach
</div>
@endsection
