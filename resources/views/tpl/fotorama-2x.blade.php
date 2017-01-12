@php ($w = $w ?? 1000)
@php ($h = ($h ?? 750) + 68)
<div class="pic-container shortcuts-item">
  <div class="pic-centered-container" style="max-width: {{ $w }}px;">
    <div class="pic" style="padding-bottom: {{ round($h / $w, 2) * 100 }}%;">
      <div class="shortcuts-item">
        <div class="js-lazy" data-lazy-type="fotorama-2x" data-width="1000">
          @foreach ($pics as $pic)
            <a href="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}"
               data-thumb="{{ ViewHelper::picThumb($slug ?? $trip->slug, $pic) }}"
               data-src2x="{{ ViewHelper::pic2x($slug ?? $trip->slug, $pic) }}"></a>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
