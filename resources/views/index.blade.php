@extends('base')

@section('content')
<h1 class="h5 d-md-none mb-4">
  Сергей Панков
  <span class="text-muted">
    &middot;
    vacuum kaluga
  </span>
</h1>
<div class="row justify-content-start">
  @ru
    <div class="col-md-6 col-lg-4 d-none d-md-block mb-4">
      <a class="d-flex align-items-center mb-2 link-parent" href="{{ path('Torrents@index') }}">
        <img class="size-32 mr-2" src="https://ivacuum.org/i/services/magnet.png">
        <h2 class="h3 mb-0"><span class="link">{{ trans('torrents.index') }}</span></h2>
      </a>
      <div>Сервис для скачивания файлов у многочисленных пользователей сети интернет без регистрации и рейтинга.</div>
      {{--<div class="text-muted">Дата запуска: 5 января 2017 г.</div>--}}
    </div>
  @endru
  <div class="col-md-6 col-lg-4 mb-4">
    <a class="d-flex align-items-center mb-2 link-parent" href="{{ path('Life@index') }}">
      <img class="d-none d-md-block size-32 mr-2" src="https://ivacuum.org/i/services/hosting.png">
      <h2 class="h3 mb-0"><span class="link">{{ trans('menu.life') }}</span></h2>
    </a>
    @ru
      <div>Мои заметки о жизни: поездки по городам России и мира, посещенные концерты, понравившиеся фильмы и книги.</div>
      {{--<div class="text-muted d-none d-md-block">Дата запуска: 29 сентября 2014 г.</div>--}}
    @en
      <div>Notes about my life. Trips around Russia and the whole world. Attended gigs. Favorite movies and books.</div>
    @endru
  </div>
  @ru
    <div class="col-md-6 col-lg-4 d-md-none mb-4">
      <a class="d-flex align-items-center mb-2 link-parent" href="{{ path('News@index') }}">
        <h2 class="h3 mb-0"><span class="link">{{ trans('news.index') }}</span></h2>
      </a>
      <div>Хроника развития сайта с 2004 года.</div>
    </div>
    <div class="col-md-6 col-lg-4 mb-4">
      <a class="d-flex align-items-center mb-2 link-parent" href="https://kupislona.ru/">
        <img class="d-none d-md-block size-32 mr-2" src="https://ivacuum.org/i/services/kupislona.png">
        <h2 class="h3 mb-0"><span class="link">KupiSlona.ru</span></h2>
      </a>
      <div>Доска бесплатных объявлений Калужской области.</div>
      {{--<div class="text-muted">Дата запуска: 7 декабря 2015 г.</div>--}}
    </div>
    <div class="col-md-6 col-lg-4 d-none d-md-block mb-4">
      <a class="d-flex align-items-center mb-2 link-parent" href="{{ path('Gallery@index') }}">
        <img class="size-32 mr-2" src="https://ivacuum.org/i/services/gallery.png">
        <h2 class="h3 mb-0"><span class="link">{{ trans('gallery.index') }}</span></h2>
      </a>
      <div>Хранилище изображений для последующей публикации в интернете.</div>
      {{--<p class="text-muted">Дата запуска: 8 февраля 2009 г.</p>--}}
    </div>
  @endru
  <div class="col-md-6 col-lg-4 d-none d-md-block mb-4">
    <a class="d-flex align-items-center mb-2 link-parent" href="{{ path('Dcpp@index') }}">
      <img class="size-32 mr-2" src="https://ivacuum.org/i/services/dcpp.png">
      <h2 class="h3 mb-0"><span class="link">ArtFly.DC++</span></h2>
    </a>
    @ru
      <div>Большая коллекция русских DC++ клиентов. Ответы на частые вопросы.</div>
      {{--<p class="text-muted">Дата запуска: 17 марта 2008 г.</p>--}}
    @en
      <p>Large collection of DC++ client software.</p>
    @endru
  </div>
  @ru
    <div class="col-md-6 col-lg-4 d-none d-md-block mb-4">
      <a class="d-flex align-items-center mb-2 link-parent" href="http://t.ivacuum.ru">
        <img class="size-32 mr-2" src="https://ivacuum.org/i/services/torrent.png">
        <h2 class="h3 mb-0"><span class="link">{{ trans('torrents.index') }}</span></h2>
      </a>
      <div>Исторический форум сервиса для обмена файлами внутри локальной сети Билайн.</div>
      {{--<p class="text-muted">Дата запуска: 5 июля 2010 г.</p>--}}
    </div>
    <div class="col-md-6 col-lg-4 mb-4">
      <a class="d-flex align-items-center mb-2 link-parent" href="{{ path('ParserVk@index') }}">
        <h2 class="h3 mb-0"><span class="link">{{ trans('menu.parser_vk') }}</span></h2>
      </a>
      <div>Ежедневная подборка десяти лучших постов выбранных страниц и групп ВК.</div>
      {{--<div class="text-muted">Дата запуска: 2 октября 2014 г.</div>--}}
    </div>
  @endru
  <div class="col-md-6 col-lg-4 mb-4">
    <a class="d-flex align-items-center mb-2 link-parent" href="{{ path('Coupons@index') }}">
      <h2 class="h3 mb-0"><span class="link">{{ trans('menu.coupons') }}</span></h2>
    </a>
    @ru
      <div>Коллекция способов сэкономить на услугах известных сервисов.</div>
      {{--<div class="text-muted">Дата запуска: 25 февраля 2017 г.</div>--}}
    @en
      <div>Easy ways to get discounts for well known services.</div>
    @endru
  </div>
</div>

@ru
  <h3><a class="link" href="/life">Истории о путешествиях</a></h3>
@en
  <h3><a class="link" href="/en/life">Travel stories</a></h3>
@endru

<div class="d-flex flex-wrap mobile-wide">
  @foreach ($trips as $trip)
    <div class="flex-basis-100 flex-sm-basis-50 flex-lg-basis-33 mx-auto mx-md-0 position-relative">
      <a class="d-block" href="{{ $trip->www() }}">
        <div class="hover-opacity-85 image-tint">
          <img class="image-fit-cover image-sm-4x3-2col image-lg-4x3-3col" src="{{ $trip->metaImage(500, 375) }}">
        </div>
        <div class="trip-cover-info p-3">
          <div class="f18">
            <img class="flag-16 flag-shadow" src="{{ $trip->city->country->flagUrl() }}">
            {{ $trip->title }}
            <span class="trip-cover-date">{{ $trip->timelinePeriod(true) }}</span>
          </div>
          <div class="trip-cover-description">{{ $trip->meta_description }}</div>
        </div>
      </a>
    </div>
  @endforeach
</div>
@endsection
