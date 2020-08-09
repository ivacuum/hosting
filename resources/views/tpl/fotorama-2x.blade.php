<?php
/**
 * @var bool $isCrawler
 * @var \App\Trip $trip
 */
$alt = $isCrawler && isset($trip) ? $trip->imgAltText() : '';
?>
<div class="-mt-2 mb-6 mobile-wide">
  <div class="max-w-1000px mx-auto text-center">
    @foreach ($pics as $pic)
      <div class="pb-3/4 relative js-shortcuts-item" id="{{ $pic }}">
        @if ($isCrawler)
          <img
            src="{{ ViewHelper::pic2x($slug ?? $trip->slug, $pic) }}"
            alt="{{ $alt }}"
          >
        @else
          <img
            class="absolute left-0 w-full h-full object-cover {{ $loop->first ? 'sm:rounded-t' : '' }} {{ $loop->last ? 'sm:rounded-b' : '' }} js-lazy"
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
    @endforeach
  </div>
</div>
