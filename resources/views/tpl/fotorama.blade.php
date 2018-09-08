<?php
$alt = $is_crawler && isset($trip) ? $trip->imgAltText() : '';
?>
<div class="pic-container">
  <div class="pic-centered-container">
    @foreach ($pics as $pic)
      <div class="pic js-shortcuts-item" id="{{ $pic }}">
        @if ($is_crawler)
          <img
            src="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}"
            alt="{{ $alt }}"
          >
        @else
          <img
            class="pic-group-border-radius js-lazy"
            src="https://life.ivacuum.org/0.gif"
            data-src="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}"
            alt=""
          >
        @endif
      </div>
    @endforeach
  </div>
</div>
