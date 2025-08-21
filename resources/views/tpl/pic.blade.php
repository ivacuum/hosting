<?php
/**
 * @var bool $isCrawler
 * @var \App\Domain\Life\Models\Trip $trip
 */

?>
<div class="-mt-2 mb-6 -mx-4 sm:mx-0 js-shortcuts-item" id="{{ $pic }}">
  <div class="max-w-[1000px] mx-auto text-center">
    <div class="pb-[75%] relative">
      @if ($isCrawler)
        <img
          src="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}"
          alt="{{ isset($trip) ? $trip->imgAltText() : '' }}"
        >
      @else
        <img
          class="absolute left-0 w-full h-full object-cover sm:rounded-sm"
          src="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}"
          alt=""
          loading="lazy"
        >
      @endif
    </div>
  </div>
</div>
