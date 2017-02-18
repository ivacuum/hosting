@extends('life.base', [
  'meta_title' => 'Любимые посты',

  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Любимые посты'],
  ]
])

@section('content')
<h1 class="h2 mt-0">Любимые посты</h1>
<p>Сборка ссылок на различные понравившиеся страницы в интернете.</p>

<div class="row">
  <div class="col-md-6">
    <h3>Интересное</h3>
    <ul>
      <li><a class="link" href="https://ru.wikipedia.org/wiki/Визовые_требования_для_граждан_России">Визовые требования для граждан России</a></li>
      <li><a class="link" href="http://tema.livejournal.com/1742206.html">Годен до</a></li>
      <li><a class="link" href="http://tema.livejournal.com/1741587.html">Е</a></li>
      <li><a class="link" href="http://varlamov.ru/954453.html">Загран</a></li>
      <li><a class="link" href="http://tema.livejournal.com/1755711.html">Знак парикмахерской</a></li>
      <li><a class="link" href="http://maxkatz.livejournal.com/253146.html">История троллейбуса</a></li>
      <li><a class="link" href="http://sergeydolya.livejournal.com/683299.html">Каково быть факелоносцем перед олимпиадой</a></li>
      <li><a class="link" href="http://sergeydolya.livejournal.com/928100.html">Как строят метро</a></li>
      <li><a class="link" href="http://varlamov.ru/975569.html">Как фотографировать незнакомых людей на улице</a></li>
      <li><a class="link" href="http://kalugin.livejournal.com/2007/04/">Концертный звук</a></li>
      <li><a class="link" href="http://tema.livejournal.com/1716376.html">Международные автомобильные права</a></li>
      <li><a class="link" href="http://tema.livejournal.com/1816151.html">Особенности современной китайской архитектуры</a></li>
      <li><a class="link" href="http://varlamov.ru/1141531.html">Пешеходные переходы</a></li>
      <li><a class="link" href="http://tema.livejournal.com/1905633.html">Псевдонимы в повседневной жизни</a></li>
      <li><a class="link" href="http://tema.livejournal.com/1634211.html">Реальная картина мира</a></li>
      <li><a class="link" href="http://le-milady.livejournal.com/1123842.html">Стиральные машинки в США</a></li>
      <li><a class="link" href="http://tema.livejournal.com/1845433.html">Уровень топлива и прокат</a></li>
      <li><a class="link" href="http://tema.livejournal.com/1915712.html">Эмбоссеры</a></li>
      <li><a class="link" href="http://www.artlebedev.ru/kovodstvo/sections/180/">Эстетика контроля и запрета</a></li>
    </ul>
    <br>
    <h3>Пополняемое</h3>
    <ul>
      <li><a class="link" href="http://www.geoguessr.com/">Игра на знание панорам улиц и дорог городов мира</a></li>
      <li><a class="link" href="https://www.google.com/maps/views/streetview?gl=us">Просмотр улиц на картах Гугла</a></li>
      <li><a class="link" href="http://urixblog.com/">Стереопары</a></li>
    </ul>
  </div>
  <div class="col-md-6">
    <h3>Подборки по странам</h3>
    <ul>
      <li><a class="link" href="http://varlamov.ru/1224669.html">Американское воскресенье</a></li>
      <li><a class="link" href="http://varlamov.ru/1252442.html">Арабское воскресенье</a></li>
      <li><a class="link" href="http://varlamov.ru/1257729.html">Афганское воскресенье</a></li>
      <li><a class="link" href="http://varlamov.ru/1311289.html">Африканское воскресенье</a></li>
      <li><a class="link" href="http://varlamov.ru/1277133.html">Голландское воскресенье</a></li>
      <li><a class="link" href="http://varlamov.ru/1282844.html">Исландское воскресенье</a></li>
      <li><a class="link" href="http://varlamov.ru/1247230.html">Карибское воскресенье</a></li>
      <li><a class="link" href="http://varlamov.ru/1237193.html">Китайское воскресенье</a></li>
      <li><a class="link" href="http://varlamov.ru/1271089.html">Лондонское воскресенье</a></li>
      <li><a class="link" href="http://varlamov.ru/1304706.html">Немецкое воскресенье</a></li>
      <li><a class="link" href="http://varlamov.ru/1230948.html">Пакистанское воскресенье</a></li>
      <li><a class="link" href="http://varlamov.ru/1262198.html">Саудовское воскресенье</a></li>
      <li><a class="link" href="http://varlamov.ru/1266377.html">Сингапурское воскресенье</a></li>
      <li><a class="link" href="http://varlamov.ru/1316354.html">Южноамериканское воскресенье</a></li>
      <li><a class="link" href="http://varlamov.ru/1219201.html">Японское воскресенье</a></li>
    </ul>
    <br>
    <h3>Отдельные посты про путешествия</h3>
    <ul>
      <li><a class="link" href="http://varlamov.ru/962585.html">Аруба, Банейро и Кюрасао</a></li>
      <li><a class="link" href="http://le-milady.livejournal.com/1135247.html">В каких домах живут денверовцы</a></li>
      <li><a class="link" href="http://varlamov.ru/1179472.html">Золотая неделя в Китае</a></li>
      <li><a class="link" href="http://sergeydolya.livejournal.com/749434.html">Новая Зеландия, обсерватория Маунт Джон</a></li>
      <li><a class="link" href="http://varlamov.ru/1068082.html">Огненная земля</a></li>
      <li><a class="link" href="http://varlamov.ru/821860.html">Остров Мэн</a></li>
      <li><a class="link" href="http://varlamov.ru/1052381.html">Токийский метрополитен</a></li>
      <li><a class="link" href="http://varlamov.ru/961524.html">Фейсбук (офис)</a></li>
    </ul>
  </div>
</div>
@endsection
