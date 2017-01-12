<div class="pic-container shortcuts-item">
  <div class="pic-centered-container">
    <div class="pic">
      <img class="js-lazy"
           src="https://life.ivacuum.ru/0.gif"
           data-src="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}"
           data-src2x="{{ ViewHelper::pic2x($slug ?? $trip->slug, $pic) }}">
    </div>
  </div>
</div>
