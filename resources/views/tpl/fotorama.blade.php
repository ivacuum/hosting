<div class="shortcuts-item">
  <div class="fotorama">
    @foreach ($pics as $pic)
      <a href="https://life.ivacuum.ru/{{ $trip->slug }}/{{ $pic }}" data-thumb="https://life.ivacuum.ru/{{ $trip->slug }}/t/{{ $pic }}"></a>
    @endforeach
  </div>
</div>
