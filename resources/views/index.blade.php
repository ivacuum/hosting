@extends('base')

@section('content')
<div class="d-flex flex-row flex-wrap justify-content-start services-container">
  @ru
    <div class="service-container d-none d-sm-block">
      <a class="d-flex align-items-center mb-2 link-highlighted-parent" href="{{ path('Torrents@index') }}">
        <img class="service-image mr-2" src="https://ivacuum.org/i/services/magnet.png">
        <h2 class="service-title"><span class="link">{{ trans('torrents.index') }}</span></h2>
      </a>
      <div>Сервис для скачивания файлов у многочисленных пользователей сети интернет без регистрации и рейтинга.</div>
      {{--<div class="text-muted">Дата запуска: 5 января 2017 г.</div>--}}
    </div>
  @endru
  <div class="service-container">
    <a class="d-flex align-items-center mb-2 link-highlighted-parent" href="{{ path('Life@index') }}">
      <img class="service-image mr-2" src="https://ivacuum.org/i/services/hosting.png">
      <h2 class="service-title"><span class="link">{{ trans('menu.life') }}</span></h2>
    </a>
    @ru
      <div>Мои заметки о жизни: поездки по городам России и мира, посещенные концерты, понравившиеся фильмы и книги.</div>
      {{--<div class="text-muted d-none d-sm-block">Дата запуска: 29 сентября 2014 г.</div>--}}
    @en
      <div>Notes about my life. Trips around Russia and the whole world. Attended gigs. Favorite movies and books.</div>
    @endru
  </div>
  @ru
    <div class="service-container d-sm-none">
      <h2 class="service-title mb-2"><a class="link" href="{{ path('News@index') }}">{{ trans('news.index') }}</a></h2>
      <div>Хроника развития сайта с 2004 года.</div>
    </div>
    <div class="service-container">
      <a class="d-flex align-items-center mb-2 link-highlighted-parent" href="https://kupislona.ru/">
        <img class="service-image mr-2" src="https://ivacuum.org/i/services/kupislona.png">
        <h2 class="service-title"><span class="link">KupiSlona.ru</span></h2>
      </a>
      <div>Доска бесплатных объявлений Калужской области.</div>
      {{--<div class="text-muted">Дата запуска: 7 декабря 2015 г.</div>--}}
    </div>
    <div class="service-container d-none d-sm-block">
      <a class="d-flex align-items-center mb-2 link-highlighted-parent" href="{{ path('Gallery@index') }}">
        <img class="service-image mr-2" src="https://ivacuum.org/i/services/gallery.png">
        <h2 class="service-title"><span class="link">{{ trans('gallery.index') }}</span></h2>
      </a>
      <div>Хранилище изображений для последующей публикации в интернете.</div>
      {{--<p class="text-muted">Дата запуска: 8 февраля 2009 г.</p>--}}
    </div>
  @endru
  <div class="service-container d-none d-sm-block">
    <a class="d-flex align-items-center mb-2 link-highlighted-parent" href="{{ path('Dcpp@index') }}">
      <img class="service-image mr-2" src="https://ivacuum.org/i/services/dcpp.png">
      <h2 class="service-title"><span class="link">ArtFly.DC++</span></h2>
    </a>
    @ru
      <div>Большая коллекция русских DC++ клиентов. Ответы на частые вопросы.</div>
      {{--<p class="text-muted">Дата запуска: 17 марта 2008 г.</p>--}}
    @en
      <p>Large collection of DC++ client software.</p>
    @endru
  </div>
  @ru
    <div class="service-container d-none d-sm-block">
      <a class="d-flex align-items-center mb-2 link-highlighted-parent" href="http://t.ivacuum.ru">
        <img class="service-image mr-2" src="https://ivacuum.org/i/services/torrent.png">
        <h2 class="service-title"><span class="link">{{ trans('torrents.index') }}</span></h2>
      </a>
      <div>Исторический форум сервиса для обмена файлами внутри локальной сети Билайн.</div>
      {{--<p class="text-muted">Дата запуска: 5 июля 2010 г.</p>--}}
    </div>
    <div class="service-container">
      <h2 class="service-title mb-2"><a class="link" href="{{ path('ParserVk@index') }}">{{ trans('menu.parser_vk') }}</a></h2>
      <div>Ежедневная подборка десяти лучших постов выбранных страниц и групп ВК.</div>
      {{--<div class="text-muted">Дата запуска: 2 октября 2014 г.</div>--}}
    </div>
  @endru
  <div class="service-container">
    <h2 class="service-title mb-2"><a class="link" href="{{ path('Coupons@index') }}">{{ trans('menu.coupons') }}</a></h2>
    @ru
      <div>Коллекция способов сэкономить на услугах известных сервисов.</div>
      {{--<div class="text-muted">Дата запуска: 25 февраля 2017 г.</div>--}}
    @en
      <div>Easy ways to get discounts for well known services.</div>
    @endru
  </div>
</div>

@ru
  <h2 class="mt-0"><a class="link" href="/life">Истории о путешествиях</a></h2>
@en
  <h2 class="mt-0"><a class="link" href="/en/life">Travel stories</a></h2>
@endru

@foreach ($trips->chunk(3) as $chunk)
  <div class="page-section">
    @foreach ($chunk as $trip)
      <div class="page-block page-block-1x3">
        <div class="page-block-cover">
          <div class="page-block-cover-image" style="background-image: linear-gradient(rgba(26, 26, 26, 0.1) 0%, rgba(26, 26, 26, 0.3) 50%), url({{ $trip->metaImage(400, 300) }});"></div>
          <div class="page-block-cover-info">
            <div class="page-block-cover-title">
              {{ $trip->title }}
              <span class="page-block-cover-date">{{ $trip->localizedDate() }}</span>
            </div>
            <div class="page-block-cover-description">{{ $trip->meta_description }}</div>
          </div>
          <a class="page-block-cover-link" href="{{ $trip->www() }}"></a>
        </div>
      </div>
    @endforeach
  </div>
@endforeach
@endsection
