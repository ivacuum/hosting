<div class="pic-container js-shortcuts-item" id="{{ $pic }}">
  <div class="pic-centered-container">
    <div class="pic">
      @if ($is_crawler)
        <img alt="{{ isset($trip) ? $trip->imgAltText() : '' }}"
             src="{{ ViewHelper::pic2x($slug ?? $trip->slug, $pic) }}">
      @else
        <img class="rounded-md-pic js-lazy"
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
  </div>
</div>
