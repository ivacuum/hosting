<div class="pic-container js-shortcuts-item" id="{{ $pic }}">
  <div class="pic-centered-container">
    <div class="pic">
      @if ($is_crawler)
        <img
          src="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}"
          alt="{{ isset($trip) ? $trip->imgAltText() : '' }}"
        >
      @else
        <img
          class="rounded-md-pic js-lazy"
          src="https://life.ivacuum.org/0.gif"
          data-src="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}"
          alt=""
        >
      @endif
    </div>
  </div>
</div>
