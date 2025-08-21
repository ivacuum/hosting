<?php
/**
 * @var \App\Domain\Life\Models\Trip $trip
 */
$pic1x = ViewHelper::pic($slug ?? $trip->slug, $pic);
$pic2x = ViewHelper::pic2x($slug ?? $trip->slug, $pic);
?>

<div class="-mt-2 mb-6 -mx-4 sm:mx-0 js-shortcuts-item" id="{{ $pic }}">
  <div class="max-w-[1000px] mx-auto text-center">
    <div class="pb-[75%] relative">
      @if ($isCrawler)
        <img
          src="{{ $pic2x }}"
          alt="{{ $trip?->imgAltText() ?? '' }}"
        >
      @else
        <img
          class="absolute left-0 w-full h-full object-cover sm:rounded-sm"
          src="{{ $pic1x }}"
          srcset="{{ $pic1x }} 1000w, {{ $pic2x }} 2000w"
          alt=""
          loading="lazy"
        >
        <div class="absolute top-0 right-0">
          @if(empty($slug))
            <a
              class="flex items-center justify-center p-2 text-white hover:text-gray-200 drop-shadow-xs/90 hover:drop-shadow-sm/90"
              href="{{ to('photos/map', ['photo' => $slug ?? "{$trip->slug}/{$pic}"]) }}"
            >
              @svg (map-marker)
            </a>
          @endif
          <a
            class="flex items-center justify-center p-2 text-white hover:text-gray-200 drop-shadow-xs/90 hover:drop-shadow-sm/90"
            href="{{ $pic2x }}"
          >
            @svg (link)
          </a>
        </div>
      @endif
    </div>
  </div>
</div>
