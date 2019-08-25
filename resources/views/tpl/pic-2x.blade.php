<div class="tw--mt-2 tw-mb-6 tw-mobile-wide js-shortcuts-item" id="{{ $pic }}">
  <div class="tw-max-w-1000px tw-mx-auto tw-text-center">
    <div class="tw-pb-3/4 tw-relative">
      @if ($is_crawler)
        <img
          src="{{ ViewHelper::pic2x($slug ?? $trip->slug, $pic) }}"
          alt="{{ isset($trip) ? $trip->imgAltText() : '' }}"
        >
      @else
        <img
          class="tw-absolute tw-left-0 tw-w-full tw-h-full tw-object-cover sm:tw-rounded js-lazy"
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
  </div>
</div>
