<?php
/** @var bool $is_crawler */
$alt = $is_crawler && isset($trip) ? $trip->imgAltText() : '';
?>
<div class="-mt-2 mb-6 mobile-wide">
  <div class="max-w-1000px mx-auto text-center">
    @foreach ($pics as $pic)
      <div class="pb-3/4 relative js-shortcuts-item" id="{{ $pic }}">
        @if ($is_crawler)
          <img
            src="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}"
            alt="{{ $alt }}"
          >
        @else
          <img
            class="absolute left-0 w-full h-full object-cover {{ $loop->first ? 'sm:rounded-t' : '' }} {{ $loop->last ? 'sm:rounded-b' : '' }} js-lazy"
            src="https://life.ivacuum.org/0.gif"
            data-src="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}"
            alt=""
          >
        @endif
      </div>
    @endforeach
  </div>
</div>
