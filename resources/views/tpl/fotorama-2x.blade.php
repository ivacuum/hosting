<div class="shortcuts-item">
  <div class="js-fotorama-2x" data-width="1000">
    @foreach ($pics as $pic)
      <a href="https://life.ivacuum.ru/{{ $trip->slug }}/{{ $pic }}" data-thumb="https://life.ivacuum.ru/{{ $trip->slug }}/t/{{ $pic }}" data-src-2x="https://life.ivacuum.ru/{{ $trip->slug }}/{{ pathinfo($pic)['filename'] }}@2x.{{ pathinfo($pic)['extension'] }}"></a>
    @endforeach
  </div>
</div>
