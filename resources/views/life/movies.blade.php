@extends('life.base', [
  'meta_title' => 'Любимые фильмы и сериалы',

  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Любимые фильмы и сериалы'],
  ]
])

@section('content')
<h2>Фильмы и сериалы, достойные многократного просмотра</h2>
<section class="movies-container">
  <div class="page-header">
    <div class="h2">2016 год</div>
  </div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => 'Ночной администратор<br>The Night Manager', 'id' => 462649],
    ]
  ])
</section>

<section class="movies-container">
  <div class="page-header">
    <div class="h2">2015 год</div>
  </div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => 'Головоломка<br>Inside Out', 'id' => 645118],
      ['title' => 'Kingsman: Секретная служба<br>Kingsman: The Secret Service', 'id' => 749540],
    ]
  ])
</section>

<section class="movies-container">
  <div class="page-header">
    <div class="h2">2014 год</div>
  </div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => 'Бёрдмэн<br>Birdman', 'id' => 722827],
      ['title' => 'Грань будущего<br>Edge of Tomorrow', 'id' => 505851],
      ['title' => 'Фарго<br>Fargo', 'id' => 767379],
      ['title' => 'Исчезнувшая<br>Gone Girl', 'id' => 692861],
      ['title' => 'Интерстеллар<br>Interstellar', 'id' => 258687],
      ['title' => 'Кремниевая долина<br>Silicon Valley', 'id' => 723959],
      ['title' => 'Настоящий детектив<br>True Detective', 'id' => 681831],
    ]
  ])
</section>

<section class="movies-container">
  <div class="page-header">
    <div class="h2">2013 год</div>
  </div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => 'Далласский клуб покупателей<br>Dallas Buyers Club', 'id' => 260162],
      ['title' => 'Она<br>Her', 'id' => 577488],
      ['title' => 'Карточный домик<br>House of Cards', 'id' => 581937],
      ['title' => 'Одержимость<br>Whiplash', 'id' => 725190],
      ['title' => 'Волк с Уолл-стрит<br>Wolf of Wall Street', 'id' => 462682],
    ]
  ])
</section>

<section class="movies-container">
  <div class="page-header">
    <div class="h2">2011 год</div>
  </div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => 'Родина<br>Homeland', 'id' => 574688],
      ['title' => '1+1<br>Intouchables', 'id' => 535341],
      ['title' => 'Бесстыдники<br>Shameless', 'id' => 571335],
      ['title' => 'Форс-мажоры<br>Suits', 'id' => 557806],
      ['title' => 'Однажды в Ирландии<br>The Guard', 'id' => 484474],
    ]
  ])
</section>

<section class="movies-container">
  <div class="page-header">
    <div class="h2">2010 год</div>
  </div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => 'Начало<br>Inception', 'id' => 447301],
      ['title' => 'Шерлок<br>Sherlock', 'id' => 502838],
    ]
  ])
</section>

<section class="movies-container">
  <div class="page-header">
    <div class="h2">2009 год</div>
  </div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => 'Три идиота<br>3 Idiots', 'id' => 423210],
    ]
  ])
</section>

<section class="movies-container">
  <div class="page-header">
    <div class="h2">2008 год</div>
  </div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => "Бобро поржаловать!<br>Bienvenue chez les Ch'tis", 'id' => 391735],
      ['title' => 'Во все тяжкие<br>Breaking Bad', 'id' => 404900],
      ['title' => 'Всегда говори «ДА»<br>Yes Man', 'id' => 391772],
      ['title' => 'ВАЛЛ·И<br>WALL·E', 'id' => 279102],
    ]
  ])
</section>

<section class="movies-container">
  <div class="page-header">
    <div class="h2">2007 год</div>
  </div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => 'Залечь на дно в Брюгге<br>In Bruges', 'id' => 276295],
      ['title' => 'В диких условиях<br>Into the Wild', 'id' => 252626],
      ['title' => 'Человек с Земли<br>The Man from Earth', 'id' => 252900],
      ['title' => 'Старикам тут не место<br>No Country for Old Men', 'id' => 195434],
      ['title' => 'Теория большого взрыва<br>The Big Bang Theory', 'id' => 306084],
    ]
  ])
</section>

<section class="movies-container">
  <div class="page-header">
    <div class="h2">2006 год</div>
  </div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => 'Жизнь других<br>Das Leben der Anderen', 'id' => 126196],
      ['title' => 'Отступники<br>The Departed', 'id' => 81314],
      ['title' => 'Престиж<br>The Prestige', 'id' => 195334],
    ]
  ])
</section>

<section class="movies-container">
  <div class="page-header">
    <div class="h2">2005 год</div>
  </div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => 'Счастливое число Слевина<br>Lucky Number Slevin', 'id' => 86326],
    ]
  ])
</section>

<section class="movies-container">
  <div class="page-header">
    <div class="h2">2004 год</div>
  </div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => 'Вечное сияние чистого разума<br>Eternal Sunshine of the Spotless Mind', 'id' => 5492],
      ['title' => 'Терминал<br>Terminal', 'id' => 6877],
    ]
  ])
</section>

<section class="movies-container">
  <div class="page-header">
    <div class="h2">2002 год</div>
  </div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => 'Поймай меня, если сможешь<br>Catch Me If You Can', 'id' => 324],
    ]
  ])
</section>

<section class="movies-container">
  <div class="page-header">
    <div class="h2">2000 год</div>
  </div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => 'Изгой<br>Cast Away', 'id' => 627],
      ['title' => 'Большой куш<br>Snatch', 'id' => 526],
    ]
  ])
</section>

<section class="movies-container">
  <div class="page-header">
    <div class="h2">1999 год</div>
  </div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => 'Бойцовский клуб<br>Fight Club', 'id' => 361],
      ['title' => 'Зеленая миля<br>The Green Mile', 'id' => 435],
      ['title' => 'Шестое чувство<br>The Sixth Sense', 'id' => 395],
    ]
  ])
</section>

<section class="movies-container">
  <div class="page-header">
    <div class="h2">1998 год</div>
  </div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => 'Карты, деньги, два ствола<br>Lock, Stock and Two Smoking Barrels', 'id' => 522],
      ['title' => 'Шоу Трумана<br>The Truman Show', 'id' => 4541],
    ]
  ])
</section>

<section class="movies-container">
  <div class="page-header">
    <div class="h2">1997 год</div>
  </div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => 'Секреты Лос-Анджелеса<br>L.A. Confidential', 'id' => 363],
      ['title' => 'Игра<br>The Game', 'id' => 12198],
    ]
  ])
</section>

<section class="movies-container">
  <div class="page-header">
    <div class="h2">1996 год</div>
  </div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => 'Заводила<br>Kingpin', 'id' => 4343],
    ]
  ])
</section>

<section class="movies-container">
  <div class="page-header">
    <div class="h2">1993 год</div>
  </div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => 'День сурка<br>Groundhog Day', 'id' => 527],
    ]
  ])
</section>

<section class="movies-container">
  <div class="page-header">
    <div class="h2">1991 год</div>
  </div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => 'Терминатор 2: Судный день<br>Terminator 2: Judgement Day', 'id' => 444],
    ]
  ])
</section>
@stop
