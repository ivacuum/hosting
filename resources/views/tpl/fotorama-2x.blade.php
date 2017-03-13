@php ($w = $w ?? 1000)
@php ($h = $h ?? 750)
<div class="pic-container shortcuts-item">
  @foreach ($pics as $pic)
    <a name="{{ $pic }}"></a>
  @endforeach
  <div class="pic-centered-container" style="max-width: {{ $w }}px;">
    <div class="pic" style="padding-bottom: calc({{ round($h / $w, 2) * 100 }}% + 68px);">
      <div class="shortcuts-item">
        <div class="js-lazy" data-lazy-type="fotorama-2x" data-width="1000">
          @foreach ($pics as $pic)
            <a hidden href="{{ ViewHelper::pic($slug ?? $trip->slug, $pic) }}"
               data-thumb="{{ ViewHelper::picThumb($slug ?? $trip->slug, $pic) }}"
               data-src2x="{{ ViewHelper::pic2x($slug ?? $trip->slug, $pic) }}"></a>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
