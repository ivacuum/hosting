<div class="pic-container shortcuts-item">
  <div class="pic-centered-container" style="max-width: {{ $w }}px;">
    <div class="pic" style="padding-bottom: {{ round($h / $w, 2) * 100 }}%;">
      <img class="js-lazy"
           src="https://life.ivacuum.ru/0.gif"
           data-src="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}">
    </div>
  </div>
</div>
