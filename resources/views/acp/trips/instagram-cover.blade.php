<?php /** @var App\Trip $trip */ ?>
<!DOCTYPE html>
<html lang="{{ $locale }}">
<head>
  <meta charset="utf-8">
  <title>{{ $trip->title }}</title>
  <meta name="robots" content="noindex, nofollow">
  <link rel="stylesheet" href="{{ mix('/assets/app.css') }}">
  <link rel="stylesheet" href="{{ mix('/assets/tailwind.css') }}">
</head>
<body>
<div style="max-width: 1080px; max-height: 1920px;">
  <div class="relative">
    <a class="block" href="{{ $trip->www() }}">
      <div class="relative pb-3/4">
        <img
          class="absolute w-full h-full object-cover bg-gray-700 brightness-3/4"
          src="{{ ViewHelper::pic2x($trip->slug, $trip->meta_image) }}"
          alt=""
        >
      </div>
      <div class="absolute bottom-0 text-white trip-cover-info p-12 w-full">
        <div class="flex flex-wrap items-baseline font-bold" style="font-size: 4.5rem;">
          <img class="flag-4x3 text-6xl mr-3 svg-shadow" src="{{ $trip->city->country->flagUrl() }}" alt="">
          <span class="leading-none mr-3">{{ $trip->title }}</span>
          <span class="leading-tight self-end text-grey-300 text-4xl">{{ $trip->timelinePeriodWithYear() }}</span>
        </div>
        @if ($trip->metaDescription())
          <div class="leading-tight mt-1" style="font-size: 2.5rem;">{{ $trip->metaDescription() }}</div>
        @endif
      </div>
    </a>
  </div>
  <div>
    <img src="https://life.ivacuum.org/z/instagram-profile-link.png" alt="">
  </div>
</div>
</body>
</html>
