<?php
/**
 * @var bool $isCrawler
 * @var \App\Trip $trip
 */
$alt = $isCrawler && isset($trip) ? $trip->imgAltText() : '';
?>
<div class="-mt-2 mb-6 -mx-4 sm:mx-0">
  <div class="max-w-[1000px] mx-auto text-center">
    @foreach ($pics as $pic)
      <div class="pb-[75%] relative js-shortcuts-item" id="{{ $pic }}">
        @if ($isCrawler)
          <img
            src="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}"
            alt="{{ $alt }}"
          >
        @else
          <img
            class="absolute left-0 w-full h-full object-cover {{ $loop->first ? 'sm:rounded-t' : '' }} {{ $loop->last ? 'sm:rounded-b' : '' }}"
            src="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}"
            alt=""
            loading="lazy"
          >
        @endif
      </div>
    @endforeach
  </div>
</div>
