<?php /** @var \App\Trip $trip */ ?>

<div class="-mt-2 mb-6 -mx-4 sm:mx-0 js-shortcuts-item" id="{{ $pic }}">
  <div class="max-w-[1000px] mx-auto text-center">
    <div class="pb-[75%] relative">
      @if ($isCrawler)
        <img
          src="{{ ViewHelper::pic2x($slug ?? $trip->slug, $pic) }}"
          alt="{{ isset($trip) ? $trip->imgAltText() : '' }}"
        >
      @else
        <img
          class="absolute left-0 w-full h-full object-cover sm:rounded"
          src="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}"
          srcset="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }} 1000w, {{ ViewHelper::pic2x($slug ?? $trip->slug, $pic) }} 2000w"
          alt=""
          loading="lazy"
        >
        <div class="absolute top-0 right-0">
          @if(empty($slug))
            <a
              class="flex items-center justify-center p-2 text-white svg-shadow"
              href="{{ to('photos/map', ['photo' => $slug ?? "{$trip->slug}/{$pic}"]) }}"
            >
              @svg (map-marker)
            </a>
          @endif
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
