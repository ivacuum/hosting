<div class="tw--mt-2 tw-mb-6 tw-mobile-wide js-shortcuts-item" id="{{ $pic }}">
  <div class="tw-max-w-1000px tw-mx-auto tw-text-center">
    <div class="tw-pb-3/4 tw-relative">
      @if ($is_crawler)
        <img
          src="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}"
          alt="{{ isset($trip) ? $trip->imgAltText() : '' }}"
        >
      @else
        <img
          class="tw-absolute tw-left-0 tw-w-full tw-h-full tw-object-cover sm:tw-rounded js-lazy"
          src="https://life.ivacuum.org/0.gif"
          data-src="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}"
          alt=""
        >
      @endif
    </div>
  </div>
</div>
