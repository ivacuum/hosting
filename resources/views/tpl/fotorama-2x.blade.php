<?php
$alt = $is_crawler && isset($trip) ? $trip->imgAltText() : '';
?>
<div class="pic-container">
  <div class="pic-centered-container">
    @foreach ($pics as $pic)
      <div class="pic js-shortcuts-item" id="{{ $pic }}">
        @if ($is_crawler)
          <img alt="{{ $alt }}" src="{{ ViewHelper::pic2x($slug ?? $trip->slug, $pic) }}">
        @else
          <img class="js-lazy {{ $loop->first ? 'rounded-bottom-0' : '' }} {{ $loop->last ? 'rounded-top-0' : '' }} {{ !$loop->first && !$loop->last ? 'rounded-0' : '' }}"
               alt=""
               src="https://life.ivacuum.ru/0.gif"
               data-src="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}"
               data-src2x="{{ ViewHelper::pic2x($slug ?? $trip->slug, $pic) }}">
          <div class="photo-overlay-buttons">
            <a class="d-flex align-items-center justify-content-center p-2 photo-overlay-button"
               href="{{ path('Photos@map', ['photo' => $slug ?? $trip->slug.'/'.$pic]) }}">
              @svg (map-marker)
            </a>
            <a class="d-flex align-items-center justify-content-center p-2 photo-overlay-button"
               href="{{ ViewHelper::pic2x($slug ?? $trip->slug, $pic) }}">
              @svg (link)
            </a>
          </div>
        @endif
      </div>
    @endforeach
  </div>
</div>
