@extends('life.base', [
  'meta_title' => 'Заметки из жизни',
])

@section('content')
<div class="h2">Заметки из жизни</div>
<p>Оглавление публикуемой мною информации.</p>

<section>
  <div class="row">
    <div class="col-sm-6">
      <h2>Поездки</h2>
      <ul class="list-inline trips-show-by">
        <li><mark>по годам</mark></li>
        <li><a class="link" href="/life/countries">по странам</a></li>
        <li><a class="link" href="/life/cities">по городам</a></li>
      </ul>

      <?php $year = false; ?>
      @foreach ($trips as $trip)
        <div class="travel-entry">
          @if ($year !== $trip->year)
            <span class="travel-year">{{ $trip->year }}</span>
          @endif
          @if ($trip->published)
            <a class="link" href="/life/{{ $trip->slug }}">{{ $trip->title }}</a>
          @else
            {{ $trip->title }}
          @endif
          <span class="travel-month">{{ $trip->period }}</span>
        </div>
        <?php $year = $trip->year; ?>
      @endforeach
    </div>
    <div class="col-sm-6">
      <h2>Избранное</h2>
      <div class="favorites-entry">
        <a class="link" href="/life/chillout">Chillout</a>
      </div>
      <div class="favorites-entry">
        <a class="link" href="/life/books">Книги</a>
      </div>
      <div class="favorites-entry">
        <a class="link" href="/life/gigs">Концерты</a>
      </div>
      <div class="favorites-entry">
        <a class="link" href="/life/favorite-posts">Любимые посты</a>
      </div>
      <div class="favorites-entry">
        <a class="link" href="/life/podcasts">Подкасты</a>
      </div>
      <div class="favorites-entry">
        <a class="link" href="/life/laundry">Условные обозначения стирки</a>
      </div>
      <div class="favorites-entry">
        <a class="link" href="/life/movies">Фильмы и сериалы</a>
      </div>
    </div>
  </div>
</section>
@endsection
