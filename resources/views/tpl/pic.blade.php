<div class="pic-container js-shortcuts-item" id="{{ $pic }}">
  <div class="pic-centered-container">
    <div class="pic">
      @if ($is_crawler)
        <img alt="{{ isset($trip) ? $trip->imgAltText() : '' }}"
             src="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}">
      @else
        <img class="rounded-md-pic js-lazy"
             alt=""
             src="https://life.ivacuum.org/0.gif"
             data-src="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}">
      @endif
    </div>
  </div>
</div>
