<div class="pic-container js-shortcuts-item" id="{{ $pic }}">
  <div class="pic-centered-container" style="max-width: {{ $w }}px;">
    <div class="pic" style="padding-bottom: {{ round($h / $w, 2) * 100 }}%;">
      <img class="rounded-md-pic js-lazy"
           src="https://life.ivacuum.org/0.gif"
           data-src="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}">
    </div>
  </div>
</div>
