@extends('life.base', [
  'meta_title' => 'Какими вещами и сервисами пользуюсь в путешествиях',

  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Чем пользуюсь в путешествиях'],
  ]
])

@section('content')
<h2>Чем пользуюсь в путешествиях</h2>
<p>Золотая тройка вещей: паспорт, деньги и телефон.</p>

<section>
  <h3 class="m-t-0">Мобильные приложения</h3>
  <div class="favorites-entry">
    2GIS
    <a href="https://play.google.com/store/apps/details?id=ru.dublgis.dgismobile">
      @svg (android)
    </a>
    <a href="https://itunes.apple.com/ru/app/2gis/id481627348?mt=8">
      @svg (apple)
    </a>
    — карты России, знают как работает общественный транспорт, после скачивания карт работают без интернета
  </div>
  <div class="favorites-entry">
    maps.me
    <a href="https://play.google.com/store/apps/details?id=com.mapswithme.maps.pro">
      @svg (android)
    </a>
    <a href="https://itunes.apple.com/ru/app/id510623322?mt=8">
      @svg (apple)
    </a>
    — карты всего мира, после скачивания карт работают без интернета
  </div>
</section>

<section>
  <h3 class="m-t-0">Навигация в городах</h3>
  <ul class="list-unstyled">
    <li>
      <a class="link" href="http://wikitravel.org">wikitravel.org</a>
      — как добраться до выбранного города, на что обратить внимание и многое другое
    </li>
  </ul>
</section>

<section>
  <h3 class="m-t-0">Выгодные предложения</h3>
  <ul class="list-unstyled">
    <li>
      <a class="link" href="http://vandrouki.ru/">vandrouki.ru</a>
      — преимущественно отправление из России
    </li>
    <li>
      <a class="link" href="http://travelfree.info/">travelfree.info</a>
      — предложения по всему миру
    </li>
  </ul>
</section>

<section>
  <h3 class="m-t-0">Авиабилеты</h3>
  <ul class="list-unstyled">
    <li><a class="link" href="https://www.aviasales.ru/?marker=79853">aviasales.ru</a></li>
    <li><a class="link" href="https://www.skyscanner.ru/">skyscanner.ru</a></li>
  </ul>
</section>

<section>
  <h3 class="m-t-0">Жилье</h3>
  <ul class="list-unstyled">
    <li>
      <a class="link" href="https://www.airbnb.ru/c/spankov1?s=8">airbnb.ru</a>
      — аренда квартир, комнат и домов у местных жителей
      {{--
      <a class="link" href="https://www.couchsurfing.com/">couchsurfing.com</a>
      — возможность бесплатно приютиться у местных
      --}}
    </li>
  </ul>
</section>

<section>
  <h3 class="m-t-0">Автобусы</h3>
  <ul class="list-unstyled">
    <li>
      <a class="link" href="https://www.busradar.com/">busradar.com</a>
      — начало поиска, а дальше уже покупка билетов на сайтах местных перевозчиков
    </li>
  </ul>
</section>

<section>
  <h3 class="m-t-0">Железнодорожное сообщение</h3>
  <ul class="list-unstyled">
    <li>
      <a class="link" href="https://pass.rzd.ru/">pass.rzd.ru</a>
      — Россия
    </li>
    <li>
      <a class="link" href="https://www.bahn.de/p_en/view/index.shtml">bahn.de</a>
      — Германия (предложения также видны на busradar.com)
    </li>
    <li>
      <a class="link" href="http://www.renfe.com/EN/viajeros/index.html">renfe.com</a>
      — Испания
    </li>
    <li>
      <a class="link" href="https://www.thalys.com/">thalys.com</a>
      — Европа
    </li>
  </ul>
</section>
@endsection
