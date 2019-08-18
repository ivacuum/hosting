@extends('life.base', [
  'meta_title' => 'Любимые посты',

  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Любимые посты'],
  ]
])

@section('content')
<h1 class="h2">Любимые посты</h1>
<p>Сборка ссылок на различные понравившиеся страницы в интернете.</p>

<div class="row">
  <div class="col-md">
    <h3>Интересное</h3>
    <ul>
      <li><a class="link" href="https://ru.wikipedia.org/wiki/Визовые_требования_для_граждан_России" rel="nofollow">Визовые требования для граждан России</a></li>
      <li><a class="link" href="https://tema.livejournal.com/1742206.html" rel="nofollow">Годен до</a></li>
      <li><a class="link" href="https://tema.livejournal.com/1741587.html" rel="nofollow">Е</a></li>
      <li><a class="link" href="https://varlamov.ru/954453.html" rel="nofollow">Загран</a></li>
      <li><a class="link" href="https://tema.livejournal.com/1755711.html" rel="nofollow">Знак парикмахерской</a></li>
      <li><a class="link" href="https://maxkatz.livejournal.com/253146.html" rel="nofollow">История троллейбуса</a></li>
      <li><a class="link" href="https://sergeydolya.livejournal.com/683299.html" rel="nofollow">Каково быть факелоносцем перед олимпиадой</a></li>
      <li><a class="link" href="https://sergeydolya.livejournal.com/928100.html" rel="nofollow">Как строят метро</a></li>
      <li><a class="link" href="https://varlamov.ru/975569.html" rel="nofollow">Как фотографировать незнакомых людей на улице</a></li>
      <li><a class="link" href="https://kalugin.livejournal.com/2007/04/" rel="nofollow">Концертный звук</a></li>
      <li><a class="link" href="https://tema.livejournal.com/2751849.html" rel="nofollow">Кухонный измельчитель</a></li>
      <li><a class="link" href="https://tema.livejournal.com/1716376.html" rel="nofollow">Международные автомобильные права</a></li>
      <li><a class="link" href="https://tema.livejournal.com/1816151.html" rel="nofollow">Особенности современной китайской архитектуры</a></li>
      <li><a class="link" href="https://varlamov.ru/1141531.html" rel="nofollow">Пешеходные переходы</a></li>
      <li><a class="link" href="https://tema.livejournal.com/1905633.html" rel="nofollow">Псевдонимы в повседневной жизни</a></li>
      <li><a class="link" href="https://tema.livejournal.com/1634211.html" rel="nofollow">Реальная картина мира</a></li>
      <li><a class="link" href="https://le-milady.livejournal.com/1123842.html" rel="nofollow">Стиральные машинки в США</a></li>
      <li><a class="link" href="https://tema.livejournal.com/1845433.html" rel="nofollow">Уровень топлива и прокат</a></li>
      <li><a class="link" href="https://tema.livejournal.com/1915712.html" rel="nofollow">Эмбоссеры</a></li>
      <li><a class="link" href="https://www.artlebedev.ru/kovodstvo/sections/180/" rel="nofollow">Эстетика контроля и запрета</a></li>
    </ul>
    <h3 class="tw-mt-12">Пополняемое</h3>
    <ul>
      <li><a class="link" href="http://www.geoguessr.com/" rel="nofollow">Игра на знание панорам улиц и дорог городов мира</a></li>
      <li><a class="link" href="https://www.google.com/maps/views/streetview?gl=us" rel="nofollow">Просмотр улиц на картах Гугла</a></li>
      <li><a class="link" href="http://urixblog.com/" rel="nofollow">Стереопары</a></li>
    </ul>
  </div>
  <div class="col-md">
    <h3>Подборки по странам</h3>
    <ul>
      <li><a class="link" href="https://varlamov.ru/1224669.html" rel="nofollow">Американское воскресенье</a></li>
      <li><a class="link" href="https://varlamov.ru/1252442.html" rel="nofollow">Арабское воскресенье</a></li>
      <li><a class="link" href="https://varlamov.ru/1257729.html" rel="nofollow">Афганское воскресенье</a></li>
      <li><a class="link" href="https://varlamov.ru/1311289.html" rel="nofollow">Африканское воскресенье</a></li>
      <li><a class="link" href="https://varlamov.ru/1277133.html" rel="nofollow">Голландское воскресенье</a></li>
      <li><a class="link" href="https://varlamov.ru/1282844.html" rel="nofollow">Исландское воскресенье</a></li>
      <li><a class="link" href="https://varlamov.ru/1247230.html" rel="nofollow">Карибское воскресенье</a></li>
      <li><a class="link" href="https://varlamov.ru/1237193.html" rel="nofollow">Китайское воскресенье</a></li>
      <li><a class="link" href="https://varlamov.ru/1271089.html" rel="nofollow">Лондонское воскресенье</a></li>
      <li><a class="link" href="https://varlamov.ru/1304706.html" rel="nofollow">Немецкое воскресенье</a></li>
      <li><a class="link" href="https://varlamov.ru/1230948.html" rel="nofollow">Пакистанское воскресенье</a></li>
      <li><a class="link" href="https://varlamov.ru/1262198.html" rel="nofollow">Саудовское воскресенье</a></li>
      <li><a class="link" href="https://varlamov.ru/1266377.html" rel="nofollow">Сингапурское воскресенье</a></li>
      <li><a class="link" href="https://varlamov.ru/1316354.html" rel="nofollow">Южноамериканское воскресенье</a></li>
      <li><a class="link" href="https://varlamov.ru/1219201.html" rel="nofollow">Японское воскресенье</a></li>
    </ul>
    <h3 class="tw-mt-12">Отдельные посты про путешествия</h3>
    <ul>
      <li><a class="link" href="https://varlamov.ru/962585.html" rel="nofollow">Аруба, Банейро и Кюрасао</a></li>
      <li><a class="link" href="https://le-milady.livejournal.com/1135247.html" rel="nofollow">В каких домах живут денверовцы</a></li>
      <li><a class="link" href="https://varlamov.ru/1179472.html" rel="nofollow">Золотая неделя в Китае</a></li>
      <li><a class="link" href="https://sergeydolya.livejournal.com/749434.html" rel="nofollow">Новая Зеландия, обсерватория Маунт Джон</a></li>
      <li><a class="link" href="https://varlamov.ru/1068082.html" rel="nofollow">Огненная земля</a></li>
      <li><a class="link" href="https://varlamov.ru/821860.html" rel="nofollow">Остров Мэн</a></li>
      <li><a class="link" href="https://varlamov.ru/1052381.html" rel="nofollow">Токийский метрополитен</a></li>
      <li><a class="link" href="https://varlamov.ru/961524.html" rel="nofollow">Фейсбук (офис)</a></li>
    </ul>
  </div>
</div>
@endsection
