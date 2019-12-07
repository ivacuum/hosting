<div class="-mt-2 mb-6 mobile-wide relative" style="max-width: {{ $w }}px;">
  <div style="padding-bottom: {{ round($h / $w, 3) * 100 }}%;">
    <img
      class="absolute w-full h-full object-cover sm:rounded js-lazy"
      src="https://life.ivacuum.org/0.gif"
      data-srcset="{{ $pic }} {{ $w }}w"
      alt=""
    >
  </div>
</div>
