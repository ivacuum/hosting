<?php
$alt = $is_crawler && isset($trip) ? $trip->imgAltText() : '';
?>
<div class="tw--mt-2 tw-mb-6 tw-mobile-wide">
  <div class="tw-max-w-1000px tw-mx-auto tw-text-center">
    @foreach ($pics as $pic)
      <div class="tw-pb-3/4 tw-relative js-shortcuts-item" id="{{ $pic }}">
        @if ($is_crawler)
          <img
            src="{{ ViewHelper::pic2x($slug ?? $trip->slug, $pic) }}"
            alt="{{ $alt }}"
          >
        @else
          <img
            class="tw-absolute tw-left-0 tw-w-full tw-h-full tw-object-cover {{ $loop->first ? 'sm:tw-rounded-t' : '' }} {{ $loop->last ? 'sm:tw-rounded-b' : '' }} js-lazy"
            src="https://life.ivacuum.org/0.gif"
            data-src="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}"
            data-src2x="{{ ViewHelper::pic2x($slug ?? $trip->slug, $pic) }}"
            alt=""
          >
          <div class="tw-absolute tw-top-0 tw-right-0">
            <a
              class="tw-flex tw-items-center tw-justify-center tw-p-2 tw-text-white svg-shadow"
              href="{{ path('Photos@map', ['photo' => $slug ?? $trip->slug.'/'.$pic]) }}"
            >
              @svg (map-marker)
            </a>
            <a
              class="tw-flex tw-items-center tw-justify-center tw-p-2 tw-text-white svg-shadow"
              href="{{ ViewHelper::pic2x($slug ?? $trip->slug, $pic) }}"
            >
              @svg (link)
            </a>
          </div>
        @endif
      </div>
    @endforeach
  </div>
</div>
