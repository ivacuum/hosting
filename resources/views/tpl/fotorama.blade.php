<?php
$alt = $is_crawler && isset($trip) ? $trip->imgAltText() : '';
?>
<div class="pic-container">
  <div class="pic-centered-container">
    @foreach ($pics as $pic)
      <div class="pic js-shortcuts-item" id="{{ $pic }}">
        @if ($is_crawler)
          <img alt="{{ $alt }}" src="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}">
        @else
          <img class="pic-group-border-radius js-lazy"
               alt=""
               src="https://life.ivacuum.ru/0.gif"
               data-src="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}">
        @endif
      </div>
    @endforeach
  </div>
</div>
