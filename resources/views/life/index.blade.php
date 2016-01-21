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
      <div class="travel-entry">
        <span class="travel-year">2016</span>
        Минск
        <span class="travel-month">январь</span>
      </div>

      <div class="travel-entry">
        <span class="travel-year">2015</span>
        <a class="link" href="/life/vienna.2015">Вена</a>
        <span class="travel-month">декабрь</span>
      </div>
      <div class="travel-entry">
        <a class="link" href="/life/dresden.2015">Дрезден</a>
        <span class="travel-month">декабрь</span>
      </div>
      <div class="travel-entry">
        Прага
        <span class="travel-month">декабрь</span>
      </div>
      <div class="travel-entry">
        Санкт-Петербург
        <span class="travel-month">октябрь</span>
      </div>
      <div class="travel-entry">
        <a class="link" href="/life/spb.2015.08">Санкт-Петербург</a>
        <span class="travel-month">август</span>
      </div>
      <div class="travel-entry">
        <a class="link" href="/life/msk.2015.07">Москва</a>
        <span class="travel-month">июль</span>
      </div>
      <div class="travel-entry">
        <a class="link" href="/life/kazan.2015">Казань</a>
        <span class="travel-month">июнь</span>
      </div>
      <div class="travel-entry">
        Прага
        <span class="travel-month">март</span>
      </div>
      <div class="travel-entry">
        <a class="link" href="/life/kaliningrad.2015">Калининград</a>
        <span class="travel-month">февраль</span>
      </div>
      <div class="travel-entry">
        <a class="link" href="/life/kaluga.2015.01.01">Калуга</a>
        <span class="travel-month">январь</span>
      </div>

      <div class="travel-entry">
        <span class="travel-year">2014</span>
        <a class="link" href="/life/kaluga.2014.10">Калуга</a>
        <span class="travel-month">октябрь</span>
      </div>
      <div class="travel-entry">
        <a class="link" href="/life/spb.2014.09">Санкт-Петербург</a>
        <span class="travel-month">сентябрь</span>
      </div>
      <div class="travel-entry">
        Якутск
        <span class="travel-month">июнь</span>
      </div>
      <div class="travel-entry">
        <a class="link" href="/life/tula">Тула</a>
        <span class="travel-month">май</span>
      </div>
      <div class="travel-entry">
        <a class="link" href="/life/spb">Санкт-Петербург</a>
        <span class="travel-month">май</span>
      </div>
      <div class="travel-entry">
        <a class="link" href="/life/spb">Санкт-Петербург</a>
        <span class="travel-month">февраль</span>
      </div>

      <div class="travel-entry">
        <span class="travel-year">2013</span>
        <a class="link" href="/life/kaluga.2013.12">Калуга</a>
        <span class="travel-month">декабрь</span>
      </div>

      <div class="travel-entry">
        <a class="link" href="/life/kaluga.2013.09">Калуга</a>
        <span class="travel-month">сентябрь</span>
      </div>

      <div class="travel-entry">
        <a class="link" href="/life/kaluga.2013.01">Калуга</a>
        <span class="travel-month">январь</span>
      </div>

      <div class="travel-entry">
        <span class="travel-year">2012</span>
        Якутск
        <span class="travel-month">сентябрь</span>
      </div>

      <div class="travel-entry">
        Якутск
        <span class="travel-month">июнь</span>
      </div>

      <div class="travel-entry">
        <span class="travel-year">2011</span>
        Якутск
        <span class="travel-month">июль</span>
      </div>

      <div class="travel-entry">
        <span class="travel-year">2010</span>
        Санкт-Петербург
        <span class="travel-month">июль</span>
      </div>

      <div class="travel-entry">
        <span class="travel-year">2008</span>
        Санкт-Петербург
        <span class="travel-month">июль</span>
      </div>

      <div class="travel-entry">
        <span class="travel-year">2007</span>
        Шарм-эль-Шейх
        <span class="travel-month">июль</span>
      </div>
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
        <a class="link" href="/life/movies">Фильмы и сериалы</a>
      </div>
    </div>
  </div>
</section>
@endsection
