<?php
$w = $w ?? 1000;
$h = $h ?? 750;
$alt = $is_crawler && isset($trip) ? $trip->imgAltText() : '';
$percent = round($h / $w, 2) * 100;
$pic_style = "padding-bottom: calc({$percent}% + 68px);";
$pic_centered_container_style = "max-width: {$w}px;";
?>
<div class="pic-container shortcuts-item">
  @if ($is_crawler)
    @foreach ($pics as $pic)
      <div class="pic-centered-container">
        <div class="pic">
          <img alt="{{ $alt }}" src="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}">
        </div>
      </div>
    @endforeach
  @else
    @foreach ($pics as $pic)
      <a id="{{ $pic }}"></a>
    @endforeach
    <div class="pic-centered-container" style="{{ $pic_centered_container_style }}">
      <div class="pic" style="{{ $pic_style }}">
        <div class="js-lazy" data-lazy-type="fotorama">
          @foreach ($pics as $pic)
            <img src="https://life.ivacuum.ru/0.gif"
                 data-src="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}"
                 data-thumb="{{ ViewHelper::picThumb($slug ?? $trip->slug, $pic) }}">
          @endforeach
        </div>
      </div>
    </div>
  @endif
</div>
