<div class="-mt-2 mb-6 -mx-4 sm:mx-0 js-shortcuts-item" id="{{ $pic }}">
  <div class="max-w-[1000px] mx-auto text-center" style="max-width: {{ $w }}px;">
    <div class="pb-[75%] relative" style="padding-bottom: {{ round($h / $w, 2) * 100 }}%;">
      <img
        class="absolute left-0 w-full h-full object-cover sm:rounded"
        src="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}"
        alt=""
        loading="lazy"
      >
    </div>
  </div>
</div>
