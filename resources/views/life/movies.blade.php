@extends('life.base', [
  'meta_title' => 'Любимые фильмы и сериалы',

  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Любимые фильмы и сериалы'],
  ]
])

@section('content')
<h1 class="h2">Фильмы и сериалы, достойные многократного просмотра</h1>
<p>Под годом ниже подразумевается год выпуска, а не год просмотра.</p>

<div class="movies-container">
  <div class="h3">2017 год</div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => "13 причин почему\n13 Reasons Why", 'id' => 582358],
      ['title' => "Сделано в Америке\nAmerican Made", 'id' => 837552],
      ['title' => "Подлый Пит\nSneaky Pete", 'id' => 848297],
      ['title' => "Таксист\nTaeksi unjeonsa", 'id' => 1008113],
      ['title' => "Горе-творец\nThe Disaster Artist", 'id' => 828242],
    ]
  ])
</div>

<div class="movies-container mt-5">
  <div class="h3">2016 год</div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => "Хардкор\nHardcore Henry", 'id' => 778218],
      ['title' => "Ночной администратор\nThe Night Manager", 'id' => 462649],
      ['title' => "Мир Дикого Запада\nWestworld", 'id' => 195523],
    ]
  ])
</div>

<div class="movies-container mt-5">
  <div class="h3">2015 год</div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => "Головоломка\nInside Out", 'id' => 645118],
      ['title' => "Kingsman: Секретная служба\nKingsman: The Secret Service", 'id' => 749540],
      ['title' => "Нарко\nNarcos", 'id' => 821565],
    ]
  ])
</div>

<div class="movies-container mt-5">
  <div class="h3">2014 год</div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => "Бёрдмэн\nBirdman", 'id' => 722827],
      ['title' => "Грань будущего\nEdge of Tomorrow", 'id' => 505851],
      ['title' => "Фарго\nFargo", 'id' => 767379],
      ['title' => "Исчезнувшая\nGone Girl", 'id' => 692861],
      ['title' => "Интерстеллар\nInterstellar", 'id' => 258687],
      ['title' => "Дикие истории\nRelatos salvajes", 'id' => 775727],
      ['title' => "Кремниевая долина\nSilicon Valley", 'id' => 723959],
      ['title' => "Настоящий детектив\nTrue Detective", 'id' => 681831],
      ['title' => "Волк с Уолл-стрит\nWolf of Wall Street", 'id' => 462682],
    ]
  ])
</div>

<div class="movies-container mt-5">
  <div class="h3">2013 год</div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => "Далласский клуб покупателей\nDallas Buyers Club", 'id' => 260162],
      ['title' => "Она\nHer", 'id' => 577488],
      ['title' => "Карточный домик\nHouse of Cards", 'id' => 581937],
      ['title' => "Mandariinid\nМандарины", 'id' => 772017],
      ['title' => "Одержимость\nWhiplash", 'id' => 725190],
    ]
  ])
</div>

<div class="movies-container mt-5">
  <div class="h3">2012 год</div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => "Связь\nCoherence", 'id' => 760829],
    ]
  ])
</div>

<div class="movies-container mt-5">
  <div class="h3">2011 год</div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => "Black Mirror\nЧерное зеркало", 'id' => 655800],
      ['title' => "Bron/Broen\nМост", 'id' => 574497],
      ['title' => "Родина\nHomeland", 'id' => 574688],
      ['title' => "1+1\nIntouchables", 'id' => 535341],
      ['title' => "Бесстыдники\nShameless", 'id' => 571335],
      ['title' => "Форс-мажоры\nSuits", 'id' => 557806],
      ['title' => "Однажды в Ирландии\nThe Guard", 'id' => 484474],
    ]
  ])
</div>

<div class="movies-container mt-5">
  <div class="h3">2010 год</div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => "Экспорт Рэймонда\nExporting Raymond", 'id' => 581145],
      ['title' => "Начало\nInception", 'id' => 447301],
      ['title' => "Шерлок\nSherlock", 'id' => 502838],
      ['title' => "Зеро 2\nZero II", 'id' => 497882],
    ]
  ])
</div>

<div class="movies-container mt-5">
  <div class="h3">2009 год</div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => "Три идиота\n3 Idiots", 'id' => 423210],
    ]
  ])
</div>

<div class="movies-container mt-5">
  <div class="h3">2008 год</div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => "Бобро поржаловать!\nBienvenue chez les Ch'tis", 'id' => 391735],
      ['title' => "Во все тяжкие\nBreaking Bad", 'id' => 404900],
      ['title' => "Всегда говори «ДА»\nYes Man", 'id' => 391772],
      ['title' => "ВАЛЛ·И\nWALL·E", 'id' => 279102],
      ['title' => "Ип Ман\nYip Man", 'id' => 409507],
    ]
  ])
</div>

<div class="movies-container mt-5">
  <div class="h3">2007 год</div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => "Залечь на дно в Брюгге\nIn Bruges", 'id' => 276295],
      ['title' => "В диких условиях\nInto the Wild", 'id' => 252626],
      ['title' => "Человек с Земли\nThe Man from Earth", 'id' => 252900],
      ['title' => "Старикам тут не место\nNo Country for Old Men", 'id' => 195434],
      ['title' => "Теория большого взрыва\nThe Big Bang Theory", 'id' => 306084],
    ]
  ])
</div>

<div class="movies-container mt-5">
  <div class="h3">2006 год</div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => "Вавилон\nBabel", 'id' => 102125],
      ['title' => "Жизнь других\nDas Leben der Anderen", 'id' => 126196],
      ['title' => "Отступники\nThe Departed", 'id' => 81314],
      ['title' => "Престиж\nThe Prestige", 'id' => 195334],
      ['title' => "На колесах\nWo ist Fred?", 'id' => 243129],
    ]
  ])
</div>

<div class="movies-container mt-5">
  <div class="h3">2005 год</div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => "Счастливое число Слевина\nLucky Number Slevin", 'id' => 86326],
    ]
  ])
</div>

<div class="movies-container mt-5">
  <div class="h3">2004 год</div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => "Вечное сияние чистого разума\nEternal Sunshine of the Spotless Mind", 'id' => 5492],
      ['title' => "Терминал\nTerminal", 'id' => 6877],
    ]
  ])
</div>

<div class="movies-container mt-5">
  <div class="h3">2002 год</div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => "Поймай меня, если сможешь\nCatch Me If You Can", 'id' => 324],
      ['title' => "Особое мнение\nMinority Report", 'id' => 496],
    ]
  ])
</div>

<div class="movies-container mt-5">
  <div class="h3">2000 год</div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => "Изгой\nCast Away", 'id' => 627],
      ['title' => "Большой куш\nSnatch", 'id' => 526],
    ]
  ])
</div>

<div class="movies-container mt-5">
  <div class="h3">1999 год</div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => "Бойцовский клуб\nFight Club", 'id' => 361],
      ['title' => "Зеленая миля\nThe Green Mile", 'id' => 435],
      ['title' => "Шестое чувство\nThe Sixth Sense", 'id' => 395],
    ]
  ])
</div>

<div class="movies-container mt-5">
  <div class="h3">1998 год</div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => "Карты, деньги, два ствола\nLock, Stock and Two Smoking Barrels", 'id' => 522],
      ['title' => "Шоу Трумана\nThe Truman Show", 'id' => 4541],
    ]
  ])
</div>

<div class="movies-container mt-5">
  <div class="h3">1997 год</div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => "Секреты Лос-Анджелеса\nL.A. Confidential", 'id' => 363],
      ['title' => "Игра\nThe Game", 'id' => 12198],
    ]
  ])
</div>

<div class="movies-container mt-5">
  <div class="h3">1996 год</div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => "Заводила\nKingpin", 'id' => 4343],
    ]
  ])
</div>

<div class="movies-container mt-5">
  <div class="h3">1993 год</div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => "День сурка\nGroundhog Day", 'id' => 527],
    ]
  ])
</div>

<div class="movies-container mt-5">
  <div class="h3">1991 год</div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => "Терминатор 2: Судный день\nTerminator 2: Judgement Day", 'id' => 444],
    ]
  ])
</div>

<div class="movies-container mt-5">
  <div class="h3">1988 год</div>
  @include('tpl.kp_movies', [
    'movies' => [
      ['title' => "L'ours\nМедведь", 'id' => 22907],
    ]
  ])
</div>
@endsection
