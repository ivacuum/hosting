<?php
/**
 * @var bool $isCrawler
 * @var \App\Trip $trip
 */
?>
<div class="-mt-2 mb-6 mobile-wide js-shortcuts-item" id="{{ $pic }}">
  <div class="max-w-[1000px] mx-auto text-center">
    <div class="pb-[75%] relative">
      @if ($isCrawler)
        <img
          src="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}"
          alt="{{ $trip?->imgAltText() }}"
        >
      @else
        <img
          class="absolute left-0 w-full h-full object-cover sm:rounded js-lazy"
          src="https://life.ivacuum.org/0.gif"
          data-srcset="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }} 1000w"
          alt=""
        >
      @endif
    </div>
  </div>
</div>
