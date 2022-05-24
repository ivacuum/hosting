<div class="-mt-2 mb-6 mobile-wide js-shortcuts-item" id="{{ $pic }}">
  <div class="grid overflow-x-scroll sm:rounded" style="grid-template-columns: {{ $w }}px; grid-template-rows: {{ $h }}px;">
    <img
      class="w-full"
      src="{{ ViewHelper::pic2x($slug, $pic) }}"
      alt=""
      loading="lazy"
    >
  </div>
</div>
