<?php
/**
 * @var bool $isCrawler
 * @var \App\Trip $trip
 */
$alt = $isCrawler ? $trip?->imgAltText() : '';
?>
<div class="-mt-2 mb-6 mobile-wide">
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
            class="absolute left-0 w-full h-full object-cover {{ $loop->first ? 'sm:rounded-t' : '' }} {{ $loop->last ? 'sm:rounded-b' : '' }} js-lazy"
            src="https://life.ivacuum.org/0.gif"
            data-srcset="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }} 1000w"
            alt=""
          >
        @endif
      </div>
    @endforeach
  </div>
</div>
