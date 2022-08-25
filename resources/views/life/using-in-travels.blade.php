@extends('life.base', [
  'noLanguageSelector' => true,
])

@section('content')
<h1 class="font-medium text-3xl tracking-tight mb-2">@lang('Чем пользуюсь в путешествиях')</h1>
<p>Золотая тройка вещей: паспорт, деньги и телефон. В телефоне <a class="link" href="/news/271">Дримсим</a> для интернета по всему миру по доступным ценам.</p>

<section>
  <h3 class="font-medium text-2xl mb-2">Мобильные приложения</h3>
  <div>
    2GIS
    <a href="https://play.google.com/store/apps/details?id=ru.dublgis.dgismobile" rel="nofollow">
      @svg (android)
    </a>
    <a href="https://itunes.apple.com/ru/app/2gis/id481627348?mt=8" rel="nofollow">
      @svg (apple)
    </a>
    — карты России, знают как работает общественный транспорт, после скачивания карт работают без интернета
  </div>
  <div>
    maps.me
    <a href="https://play.google.com/store/apps/details?id=com.mapswithme.maps.pro" rel="nofollow">
      @svg (android)
    </a>
    <a href="https://itunes.apple.com/ru/app/id510623322?mt=8" rel="nofollow">
      @svg (apple)
    </a>
    — карты всего мира, после скачивания карт работают без интернета
  </div>
</section>

<section class="pt-12">
  <h3 class="font-medium text-2xl mb-2">Навигация в городах</h3>
  <div>
    <a class="link" href="https://wikitravel.org" rel="nofollow">wikitravel.org</a>
    — как добраться до выбранного города, на что обратить внимание и многое другое
  </div>
</section>

<section class="pt-12">
  <h3 class="font-medium text-2xl mb-2">Выгодные предложения</h3>
  <div>
    <a class="link" href="https://vandrouki.ru/" rel="nofollow">vandrouki.ru</a>
    — преимущественно отправление из России
  </div>
  <div>
    <a class="link" href="https://travelfree.info/" rel="nofollow">travelfree.info</a>
    — предложения по всему миру
  </div>
</section>

<section class="pt-12">
  <h3 class="font-medium text-2xl mb-2">Авиабилеты</h3>
  <div><a class="link" href="https://www.aviasales.ru/?marker=79853">aviasales.ru</a></div>
  <div><a class="link" href="https://www.skyscanner.ru/" rel="nofollow">skyscanner.ru</a></div>
</section>

<section class="pt-12">
  <h3 class="font-medium text-2xl mb-2">Жилье</h3>
  <div>
    <a class="link" href="https://www.airbnb.ru/c/spankov1?s=8">airbnb.ru</a>
    — аренда квартир, комнат и домов у местных жителей
    {{--
    <a class="link" href="https://www.couchsurfing.com/" rel="nofollow">couchsurfing.com</a>
    — возможность бесплатно приютиться у местных
    --}}
  </div>
</section>

<section class="pt-12">
  <h3 class="font-medium text-2xl mb-2">Автобусы</h3>
  <div>
    <a class="link" href="https://www.busradar.com/" rel="nofollow">busradar.com</a>
    — начало поиска, а дальше уже покупка билетов на сайтах местных перевозчиков
  </div>
  <div>
    <a class="link" href="https://www.goeuro.com/" rel="nofollow">goeuro.com</a>
    — аналог предыдущего примера
  </div>
</section>

<section class="pt-12">
  <h3 class="font-medium text-2xl mb-2">Железнодорожное сообщение</h3>
  <div>
    <a class="link" href="https://pass.rzd.ru/" rel="nofollow">pass.rzd.ru</a>
    — Россия
  </div>
  <div>
    <a class="link" href="https://www.bahn.de/p_en/view/index.shtml" rel="nofollow">bahn.de</a>
    — Германия (предложения также видны на busradar.com)
  </div>
  <div>
    <a class="link" href="http://www.renfe.com/EN/viajeros/index.html" rel="nofollow">renfe.com</a>
    — Испания
  </div>
  <div>
    <a class="link" href="https://www.thalys.com/" rel="nofollow">thalys.com</a>
    — Европа
  </div>
  <div>
    <a class="link" href="http://www.seat61.com/" rel="nofollow">seat61.com</a>
    — советы по перемещениям на поездах
  </div>
</section>
@endsection
