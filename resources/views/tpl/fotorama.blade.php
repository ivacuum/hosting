<?php
$alt = $is_crawler && isset($trip) ? $trip->imgAltText() : '';
?>
<div class="tw--mt-2 tw-mb-6 tw-mobile-wide">
  <div class="tw-max-w-1000px tw-mx-auto tw-text-center">
    @foreach ($pics as $pic)
      <div class="tw-pb-3/4 tw-relative js-shortcuts-item" id="{{ $pic }}">
        @if ($is_crawler)
          <img
            src="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}"
            alt="{{ $alt }}"
          >
        @else
          <img
            class="tw-absolute tw-left-0 tw-w-full tw-h-full tw-object-cover {{ $loop->first ? 'sm:tw-rounded-t' : '' }} {{ $loop->last ? 'sm:tw-rounded-b' : '' }} js-lazy"
            src="https://life.ivacuum.org/0.gif"
            data-src="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}"
            alt=""
          >
        @endif
      </div>
    @endforeach
  </div>
</div>
