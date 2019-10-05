<div class="-mt-2 mb-6 mobile-wide js-shortcuts-item" id="{{ $pic }}">
  <div class="max-w-1000px mx-auto text-center" style="max-width: {{ $w }}px;">
    <div class="pb-3/4 relative" style="padding-bottom: {{ round($h / $w, 2) * 100 }}%;">
      <img
        class="absolute left-0 w-full h-full object-cover sm:rounded js-lazy"
        src="https://life.ivacuum.org/0.gif"
        data-src="{{ ViewHelper::pic2x($slug ?? $trip->slug, $pic) }}"
        alt=""
      >
    </div>
  </div>
</div>
