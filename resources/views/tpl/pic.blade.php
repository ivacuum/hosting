<div class="-mt-2 mb-6 mobile-wide js-shortcuts-item" id="{{ $pic }}">
  <div class="max-w-1000px mx-auto text-center">
    <div class="pb-3/4 relative">
      @if ($is_crawler)
        <img
          src="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}"
          alt="{{ isset($trip) ? $trip->imgAltText() : '' }}"
        >
      @else
        <img
          class="absolute left-0 w-full h-full object-cover sm:rounded js-lazy"
          src="https://life.ivacuum.org/0.gif"
          data-src="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}"
          alt=""
        >
      @endif
    </div>
  </div>
</div>
