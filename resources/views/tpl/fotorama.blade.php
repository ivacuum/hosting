@php ($w = $w ?? 1000)
@php ($h = ($h ?? 750) + 68)
<div class="pic-container shortcuts-item">
  <div class="pic-centered-container" style="max-width: {{ $w }}px;">
    <div class="pic" style="padding-bottom: {{ round($h / $w, 2) * 100 }}%;">
      <div class="js-lazy" data-lazy-type="fotorama">
        @foreach ($pics as $pic)
          <a href="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}"
             data-thumb="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}"></a>
        @endforeach
      </div>
    </div>
  </div>
</div>
