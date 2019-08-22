<?php
$alt = $is_crawler && isset($trip) ? $trip->imgAltText() : '';
?>
<div class="pic-container">
  <div class="pic-centered-container">
    @foreach ($pics as $pic)
      <div class="pic js-shortcuts-item" id="{{ $pic }}">
        @if ($is_crawler)
          <img
            src="{{ ViewHelper::pic2x($slug ?? $trip->slug, $pic) }}"
            alt="{{ $alt }}"
          >
        @else
          <img
            class="pic-group-border-radius js-lazy"
            src="https://life.ivacuum.org/0.gif"
            data-src="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}"
            data-src2x="{{ ViewHelper::pic2x($slug ?? $trip->slug, $pic) }}"
            alt=""
          >
          <div class="photo-overlay-buttons">
            <a
              class="tw-flex tw-items-center tw-justify-center tw-p-2 photo-overlay-button"
              href="{{ path('Photos@map', ['photo' => $slug ?? $trip->slug.'/'.$pic]) }}"
            >
              @svg (map-marker)
            </a>
            <a
              class="tw-flex tw-items-center tw-justify-center tw-p-2 photo-overlay-button"
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
