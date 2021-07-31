<?php /** @var \App\Trip $trip */ ?>

<div class="-mt-2 mb-6 mobile-wide js-shortcuts-item" id="{{ $pic }}">
  <div class="max-w-[1000px] mx-auto text-center">
    <div class="pb-[75%] relative">
      @if ($isCrawler)
        <img
          src="{{ ViewHelper::pic2x($slug ?? $trip->slug, $pic) }}"
          alt="{{ isset($trip) ? $trip->imgAltText() : '' }}"
        >
      @else
        <img
          class="absolute left-0 w-full h-full object-cover sm:rounded js-lazy"
          src="https://life.ivacuum.org/0.gif"
          data-srcset="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }} 1000w, {{ ViewHelper::pic2x($slug ?? $trip->slug, $pic) }} 2000w"
          alt=""
        >
        <div class="absolute top-0 right-0">
          <a
            class="flex items-center justify-center p-2 text-white svg-shadow"
            href="{{ to('photos/map', ['photo' => $slug ?? "{$trip->slug}/{$pic}"]) }}"
          >
            @svg (map-marker)
          </a>
          <a
            class="flex items-center justify-center p-2 text-white svg-shadow"
            href="{{ ViewHelper::pic2x($slug ?? $trip->slug, $pic) }}"
          >
            @svg (link)
          </a>
        </div>
      @endif
    </div>
  </div>
</div>
