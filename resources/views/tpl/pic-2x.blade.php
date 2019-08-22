<div class="pic-container js-shortcuts-item" id="{{ $pic }}">
  <div class="pic-centered-container">
    <div class="pic">
      @if ($is_crawler)
        <img
          src="{{ ViewHelper::pic2x($slug ?? $trip->slug, $pic) }}"
          alt="{{ isset($trip) ? $trip->imgAltText() : '' }}"
        >
      @else
        <img
          class="md:tw-rounded js-lazy"
          src="https://life.ivacuum.org/0.gif"
          data-src="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}"
          data-src2x="{{ ViewHelper::pic2x($slug ?? $trip->slug, $pic) }}"
          alt=""
        >
        <div class="tw-absolute tw-top-0 tw-right-0">
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
  </div>
</div>
