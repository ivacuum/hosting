@extends('base')

@section('content')
<div class="row">
  <div class="col-md-4 service-container">
    <div class="clearfix">
      <img class="service-image" src="http://ivacuum.org/i/services/torrent.png">
      <h2 class="service-title"><a class="link" href="http://t.ivacuum.ru/">Торрент-трекер</a></h2>
    </div>
    <p>Наглядный сервис для обмена файлами внутри локальной сети Билайн с возможностью комментирования раздач.</p>
    <p>Особенности:</p>
    <ul>
      <li>обсуждение раздач;</li>
      <li>обмен на высокой скорости;</li>
      <li>отсутствие ограничений по рейтингу;</li>
      <li>и многое другое...</li>
    </ul>
    <p>Дата запуска: 5 июля 2010 г.</p>
  </div>
  <div class="col-md-4 service-container">
    <div class="clearfix">
      <img class="service-image" src="http://ivacuum.org/i/services/hosting.png">
      <h2 class="service-title"><a class="link" href="{{ action('Life@index') }}">Заметки из жизни</a></h2>
    </div>
    <p>Мои заметки о жизни:</p>
    <ul>
      <li>поездки по городам России и мира;</li>
      <li>посещенные концерты;</li>
      <li>понравившиеся фильмы и книги.</li>
    </ul>
    <p>Дата запуска: 29 сентября 2014 г.</p>
  </div>
  <div class="col-md-4 service-container">
    <div class="clearfix">
      <img class="service-image" src="http://ivacuum.org/i/services/kupislona.png">
      <h2 class="service-title"><a class="link" href="https://kupislona.ru/">KupiSlona.ru</a></h2>
    </div>
    <p>Доска объявлений Калужской области.</p>
    <p>Особенности:</p>
    <ul>
      <li>десятки тысяч актуальных объявлений;</li>
      <li>сотни рубрик для удобного поиска;</li>
      <li>бесплатная подача собственного объявления;</li>
      <li>сайт адаптирован как для больших экранов, так и для мобильных устройств.</li>
    </ul>
    <p>Дата запуска: 7 декабря 2015 г.</p>
  </div>
</div>

<div class="row">
  <div class="col-md-4 service-container">
    <div class="clearfix">
      <img class="service-image" src="http://ivacuum.org/i/services/gallery.png">
      <h2 class="service-title"><a class="link" href="http://ivacuum.ru/галерея/">Галерея</a></h2>
    </div>
    <p>Хранилище изображений для последующей публикации в интернете.</p>
    <p>Особенности:</p>
    <ul>
      <li>учет показов изображений;</li>
      <li>получение ссылок на уже загруженные картинки;</li>
      <li>отображение специальной метки, если файл скоро будет удален.</li>
    </ul>
    <p>Дата запуска: 8 февраля 2009 г.</p>
  </div>
  {{--
  <div class="col-md-4 service-container">
    <h3 class="service-title"><a class="link" href="http://up.ivacuum.ru/">Загрузка изображений</a></h3>
    <p>Сервис загрузки изображений в галерею для последующего использования на трекере.</p>
    <p>Особенности:</p>
    <ul>
      <li>загрузка до 10 изображений одновременно;</li>
      <li>получение ссылок для публикации на трекере;</li>
      <li>масштабирование и создание превью.</li>
    </ul>
    <p>Дата запуска: 8 февраля 2009 г.</p>
  </div>
  --}}
  <div class="col-md-4 service-container">
    <div class="clearfix">
      <img class="service-image" src="http://ivacuum.org/i/services/dcpp.png">
      <h2 class="service-title"><a class="link" href="http://dc.ivacuum.ru/">ArtFly.DC++</a></h2>
    </div>
    <p>Большая коллекция русских DC++ клиентов.</p>
    <p>Особенности:</p>
    <ul>
      <li>есть FAQ с ответами на самые частозадаваемые вопросы;</li>
      <li>у большинства клиентов есть русская сборка или русификатор;</li>
      <li>представлены клиенты для трёх самых популярных платформ.</li>
    </ul>
    <p>Дата запуска: 17 марта 2008 г.</p>
  </div>
</div>

{{--
@ru
  <p class="lead">Текст для главной еще не придумали. Можно <a class="link" href="{{ action('Life@index') }}">заметки</a> почитать, например.</p>
  <h3>Последние поездки</h3>
@en
  <h3 class="m-t-0">Last trips</h3>
@endlang

@foreach ($trips->chunk(3) as $chunk)
  <div class="page-section">
    @foreach ($chunk as $trip)
      <div class="page-block page-block-1x3">
        <div class="page-block-cover">
          <div class="page-block-cover-image" style="background-image: linear-gradient(rgba(26, 26, 26, 0.1) 0%, rgba(26, 26, 26, 0.3) 50%), url({{ $trip->meta_image }});"></div>
          <div class="page-block-cover-info">
            <div class="page-block-cover-title">
              {{ $trip->title }}
              <span class="page-block-cover-date">{{ $trip->period }} {{ $trip->year }}</span>
            </div>
            <div class="page-block-cover-description">{{ $trip->meta_description }}</div>
          </div>
          <a class="page-block-cover-link" href="{{ action('Life@page', $trip->slug) }}"><span></span></a>
        </div>
      </div>
    @endforeach
  </div>
@endforeach

@ru
  <p class="lead">А еще лучше слетать <a class="link pseudo js-aviasales">повидать новый город</a>.</p>
  <div id="aviasales_container"></div>
@endlang
--}}
@endsection
