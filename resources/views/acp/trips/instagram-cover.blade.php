<?php /** @var App\Trip $trip */ ?>
<!DOCTYPE html>
<html lang="{{ $locale }}">
<head>
  <meta charset="utf-8">
  <title>{{ $trip->title }}</title>
  <meta name="robots" content="noindex, nofollow">
  @vite('resources/css/app.css')
</head>
<body>
<div class="max-w-[1080px] max-h-[1920px]">
  <div class="relative">
    <a class="block" href="{{ $trip->www() }}">
      <img
        class="block aspect-[4/3] w-full object-cover bg-gray-700 brightness-3/4"
        src="{{ ViewHelper::pic2x($trip->slug, $trip->meta_image) }}"
        alt=""
      >
      <div class="absolute bottom-0 text-white trip-cover-info p-12 w-full">
        <div class="flex flex-wrap gap-3 items-baseline font-bold text-[4.5rem]">
          <img class="flag-4x3 text-6xl svg-shadow" src="{{ $trip->city->country->flagUrl() }}" alt="">
          <span class="leading-none">{{ $trip->title }}</span>
          <span class="leading-tight self-end text-grey-300 text-4xl">{{ $trip->timelinePeriodWithYear() }}</span>
        </div>
        @if ($trip->metaDescription())
          <div class="leading-tight mt-1 text-[2.5rem]">{{ $trip->metaDescription() }}</div>
        @endif
      </div>
    </a>
  </div>
  {{--
  <div>
    <img src="https://life.ivacuum.org/z/instagram-profile-link.png" alt="">
  </div>
  --}}
</div>
</body>
</html>
