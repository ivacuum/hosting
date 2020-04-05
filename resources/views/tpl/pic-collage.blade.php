<div class="-mt-2 mb-6 mobile-wide js-shortcuts-item" id="{{ $pic }}">
  <div class="grid overflow-x-scroll sm:rounded" style="grid-template-columns: {{ $w }}px; grid-template-rows: {{ $h }}px;">
    <img
      class="w-full js-lazy"
      src="https://life.ivacuum.org/0.gif"
      data-srcset="{{ ViewHelper::pic2x($slug, $pic) }} {{ $w }}w"
      alt=""
    >
  </div>
</div>
