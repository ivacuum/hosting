<div class="tw--mt-2 tw-mb-6 tw-mobile-wide js-shortcuts-item" id="{{ $pic }}">
  <div class="tw-max-w-1000px tw-mx-auto tw-text-center" style="max-width: {{ $w }}px;">
    <div class="tw-pb-3/4 tw-relative" style="padding-bottom: {{ round($h / $w, 2) * 100 }}%;">
      <img
        class="tw-absolute tw-left-0 tw-w-full tw-h-full tw-object-cover sm:tw-rounded js-lazy"
        src="https://life.ivacuum.org/0.gif"
        data-src="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}"
      >
    </div>
  </div>
</div>
