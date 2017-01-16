@extends('base')

@section('content')
<div class="row">
  <div class="col-md-4 service-container">
    <div class="clearfix">
      <img class="service-image" src="https://ivacuum.org/i/services/magnet.png">
      <h2 class="service-title"><a class="link" href="{{ action('Torrents@index') }}">{{ trans('torrents.index') }}</a> <span class="label label-warning text-lowercase">{{ trans('index.new') }}</span></h2>
    </div>
    @ru
      <p>Сервис для скачивания файлов у многочисленных пользователей сети интернет.</p>
      <ul>
        <li>зеркало раздач рутрекера;</li>
        <li>скачивание без регистрации и рейтинга;</li>
        <li>легкое добавление раздач.</li>
      </ul>
      <p>Дата запуска: 5 января 2017 г.</p>
    @endlang
  </div>
  <div class="col-md-4 service-container">
    <div class="clearfix">
      <img class="service-image" src="https://ivacuum.org/i/services/hosting.png">
      <h2 class="service-title"><a class="link" href="{{ action('Life@index') }}">{{ trans('menu.life') }}</a></h2>
    </div>
    @ru
      <p>Мои заметки о жизни.</p>
      <ul>
        <li>поездки по городам России и мира;</li>
        <li>посещенные концерты;</li>
        <li>понравившиеся фильмы и книги.</li>
      </ul>
      <p>Дата запуска: 29 сентября 2014 г.</p>
    @endlang
  </div>
  <div class="col-md-4 service-container">
    <div class="clearfix">
      <img class="service-image" src="https://ivacuum.org/i/services/kupislona.png">
      <h2 class="service-title"><a class="link" href="https://kupislona.ru/">KupiSlona.ru</a></h2>
    </div>
    @ru
      <p>Доска объявлений Калужской области.</p>
      <ul>
        <li>десятки тысяч актуальных объявлений;</li>
        <li>сотни рубрик для удобного поиска;</li>
        <li>бесплатная подача собственного объявления;</li>
        <li>сайт адаптирован как для больших экранов, так и для мобильных устройств.</li>
      </ul>
      <p>Дата запуска: 7 декабря 2015 г.</p>
    @endlang
  </div>
</div>

<div class="row">
  <div class="col-md-4 service-container">
    <div class="clearfix">
      <img class="service-image" src="https://ivacuum.org/i/services/gallery.png">
      <h2 class="service-title"><a class="link" href="{{ action('Gallery@index') }}">{{ trans('gallery.index') }}</a></h2>
    </div>
    @ru
      <p>Хранилище изображений для последующей публикации в интернете.</p>
      <ul>
        <li>учет показов изображений;</li>
        <li>получение ссылок на уже загруженные картинки;</li>
        <li>отображение специальной метки, если файл скоро будет удален.</li>
      </ul>
      <p>Дата запуска: 8 февраля 2009 г.</p>
    @endlang
  </div>
  <div class="col-md-4 service-container">
    <div class="clearfix">
      <img class="service-image" src="https://ivacuum.org/i/services/dcpp.png">
      <h2 class="service-title"><a class="link" href="{{ action('Dcpp@index') }}">ArtFly.DC++</a></h2>
    </div>
    @ru
      <p>Большая коллекция русских DC++ клиентов.</p>
      <ul>
        <li>есть FAQ с ответами на самые частозадаваемые вопросы;</li>
        <li>у большинства клиентов есть русская сборка или русификатор;</li>
        <li>представлены клиенты для трёх самых популярных платформ.</li>
      </ul>
      <p>Дата запуска: 17 марта 2008 г.</p>
    @endlang
  </div>
  <div class="col-md-4 service-container">
    <div class="clearfix">
      <img class="service-image" src="https://ivacuum.org/i/services/torrent.png">
      <h2 class="service-title"><a class="link" href="http://t.ivacuum.ru">{{ trans('torrents.index') }}</a></h2>
    </div>
    @ru
      <p>Сервис для обмена файлами внутри локальной сети Билайн, проработавший шесть с лишним лет. Теперь исторический форум, доступный из интернета.</p>
      <p>Дата запуска: 5 июля 2010 г.</p>
    @endlang
  </div>
</div>

{{--
@ru
  <h3>Последние поездки</h3>
@en
  <h3 class="m-t-0">Last trips</h3>
@endlang

@foreach ($trips->chunk(3) as $chunk)
  <div class="page-section">
    @foreach ($chunk as $trip)
      <div class="page-block page-block-1x3">
        <div class="page-block-cover">
          <div class="page-block-cover-image" style="background-image: linear-gradient(rgba(26, 26, 26, 0.1) 0%, rgba(26, 26, 26, 0.3) 50%), url({{ $trip->metaImage() }});"></div>
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
--}}
@endsection
