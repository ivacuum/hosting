<?php
/** @var App\Trip $trip */
?>

@extends('base')

@section('content')
<h1 class="tw-text-lg md:tw-hidden tw-mb-6">
  @ru Сергей Панков @en Sergey Pankov @endru
  <span class="text-muted">
    &middot;
    vacuum kaluga
  </span>
</h1>
<div class="tw-flex tw-flex-wrap tw-justify-start tw--mx-4">
  @ru
    <div class="md:tw-w-1/2 lg:tw-w-1/3 tw-hidden md:tw-block tw-mb-6 tw-px-4">
      <a class="tw-flex tw-items-center tw-mb-2 link-parent" href="{{ path('Torrents@index') }}">
        <img class="tw-mr-2 tw-w-8 tw-h-8" src="https://ivacuum.org/i/services/magnet.png">
        <h2 class="tw-text-2xl tw-mb-0"><span class="link">{{ trans('torrents.index') }}</span></h2>
      </a>
      <div>Сервис для скачивания файлов у многочисленных пользователей сети интернет без регистрации и рейтинга.</div>
      {{--<div class="text-muted">Дата запуска: 5 января 2017 г.</div>--}}
    </div>
  @endru
  <div class="md:tw-w-1/2 lg:tw-w-1/3 tw-mb-6 tw-px-4">
    <a class="tw-flex tw-items-center tw-mb-2 link-parent" href="{{ path('Life@index') }}">
      <img class="tw-hidden md:tw-block tw-mr-2 tw-w-8 tw-h-8" src="https://ivacuum.org/i/services/hosting.png">
      <h2 class="tw-text-2xl tw-mb-0"><span class="link">{{ trans('menu.life') }}</span></h2>
    </a>
    @ru
      <div>Мои заметки о жизни: поездки по городам России и мира, посещенные концерты, понравившиеся фильмы и книги.</div>
      {{--<div class="text-muted tw-hidden md:tw-block">Дата запуска: 29 сентября 2014 г.</div>--}}
    @en
      <div>Notes about my life. Trips around Russia and the whole world. Attended gigs. Favorite movies and books.</div>
    @endru
  </div>
  @ru
    <div class="md:tw-w-1/2 lg:tw-w-1/3 md:tw-hidden tw-mb-6 tw-px-4">
      <a class="tw-flex tw-items-center tw-mb-2 link-parent" href="{{ path('News@index') }}">
        <h2 class="tw-text-2xl tw-mb-0"><span class="link">{{ trans('news.index') }}</span></h2>
      </a>
      <div>Хроника развития сайта с 2004 года.</div>
    </div>
    <div class="md:tw-w-1/2 lg:tw-w-1/3 tw-mb-6 tw-px-4">
      <a class="tw-flex tw-items-center tw-mb-2 link-parent" href="https://kupislona.ru/">
        <img class="tw-hidden md:tw-block tw-mr-2 tw-w-8 tw-h-8" src="https://ivacuum.org/i/services/kupislona.png">
        <h2 class="tw-text-2xl tw-mb-0"><span class="link">KupiSlona.ru</span></h2>
      </a>
      <div>Доска бесплатных объявлений России. Место встречи продавцов и покупателей.</div>
      {{--<div class="text-muted">Дата запуска: 7 декабря 2015 г.</div>--}}
    </div>
    <div class="md:tw-w-1/2 lg:tw-w-1/3 tw-hidden md:tw-block tw-mb-6 tw-px-4">
      <a class="tw-flex tw-items-center tw-mb-2 link-parent" href="{{ path('Gallery@index') }}">
        <img class="tw-mr-2 tw-w-8 tw-h-8" src="https://ivacuum.org/i/services/gallery.png">
        <h2 class="tw-text-2xl tw-mb-0"><span class="link">{{ trans('gallery.index') }}</span></h2>
      </a>
      <div>Хранилище изображений для последующей публикации в интернете.</div>
      {{--<p class="text-muted">Дата запуска: 8 февраля 2009 г.</p>--}}
    </div>
  @endru
  <div class="md:tw-w-1/2 lg:tw-w-1/3 tw-hidden md:tw-block tw-mb-6 tw-px-4">
    <a class="tw-flex tw-items-center tw-mb-2 link-parent" href="{{ path('Dcpp@index') }}">
      <img class="tw-mr-2 tw-w-8 tw-h-8" src="https://ivacuum.org/i/services/dcpp.png">
      <h2 class="tw-text-2xl tw-mb-0"><span class="link">ArtFly.DC++</span></h2>
    </a>
    @ru
      <div>Большая коллекция русских DC++ клиентов. Ответы на вопросы. Популярные хабы.</div>
      {{--<p class="text-muted">Дата запуска: 17 марта 2008 г.</p>--}}
    @en
      <p>Large collection of DC++ client software. Popular hubs to connect.</p>
    @endru
  </div>
  @ru
    <div class="md:tw-w-1/2 lg:tw-w-1/3 tw-hidden md:tw-block tw-mb-6 tw-px-4">
      <a class="tw-flex tw-items-center tw-mb-2 link-parent" href="http://t.ivacuum.ru">
        <img class="tw-mr-2 tw-w-8 tw-h-8" src="https://ivacuum.org/i/services/torrent.png">
        <h2 class="tw-text-2xl tw-mb-0"><span class="link">{{ trans('torrents.index') }}</span></h2>
      </a>
      <div>Исторический форум сервиса для обмена файлами внутри локальной сети Билайн.</div>
      {{--<p class="text-muted">Дата запуска: 5 июля 2010 г.</p>--}}
    </div>
    <div class="md:tw-w-1/2 lg:tw-w-1/3 tw-mb-6 tw-px-4">
      <a class="tw-flex tw-items-center tw-mb-2 link-parent" href="{{ path('ParserVk@index') }}">
        <h2 class="tw-text-2xl tw-mb-0"><span class="link">{{ trans('menu.parser_vk') }}</span></h2>
      </a>
      <div>Ежедневная подборка десяти лучших постов выбранных страниц и групп ВК.</div>
      {{--<div class="text-muted">Дата запуска: 2 октября 2014 г.</div>--}}
    </div>
  @endru
  <div class="md:tw-w-1/2 lg:tw-w-1/3 tw-mb-6 tw-px-4">
    <a class="tw-flex tw-items-center tw-mb-2 link-parent" href="{{ path('Coupons@index') }}">
      <h2 class="tw-text-2xl tw-mb-0"><span class="link">{{ trans('menu.coupons') }}</span></h2>
    </a>
    @ru
      <div>Коллекция способов сэкономить на услугах известных сервисов.</div>
      {{--<div class="text-muted">Дата запуска: 25 февраля 2017 г.</div>--}}
    @en
      <div>Easy ways to get discounts for well known services.</div>
    @endru
  </div>
  <div class="md:tw-w-1/2 lg:tw-w-1/3 tw-mb-6 tw-px-4">
    <a class="tw-flex tw-items-center tw-mb-2 link-parent" href="{{ path('Japanese@index') }}">
      <h2 class="tw-text-2xl tw-mb-0"><span class="link">{{ trans('japanese.index') }}</span></h2>
    </a>
    @ru
      <div>Тренажер для запоминания слоговых азбук. Набор ключей, кандзи и словарных слов для самостоятельного изучения и повторения.</div>
    @en
      <div>Hiragana & Katakana trainer. Set of radicals, kanji and vocabulary to learn and review.</div>
    @endru
  </div>
</div>

@ru
  <h3 class="tw-text-2xl"><a class="link" href="/life">Истории о путешествиях</a></h3>
@en
  <h3 class="tw-text-2xl"><a class="link" href="/en/life">Travel stories</a></h3>
@endru

<div class="tw-flex tw-flex-wrap tw-mobile-wide">
  @foreach ($trips as $trip)
    <?php $trip->loadCityAndCountry(); ?>
    <div class="tw-w-full sm:tw-w-1/2 lg:tw-w-1/3 tw-mx-auto md:tw-mx-0 tw-relative">
      <a class="tw-block group" href="{{ $trip->www() }}">
        <div class="tw-relative tw-pb-3/4">
          <img
            class="tw-absolute tw-w-full tw-h-full tw-object-cover brightness-3/4 group-hover:brightness-full"
            src="{{ $trip->metaImage(500, 375) }}"
          >
        </div>
        <div class="tw-absolute tw-bottom-0 tw-text-white trip-cover-info tw-p-4">
          <div class="tw-text-lg">
            <img class="flag-24 svg-shadow" src="{{ $trip->city->country->flagUrl() }}">
            {{ $trip->title }}
            <span class="tw-text-gray-400 tw-text-xs">{{ $trip->timelinePeriod(true) }}</span>
          </div>
          <div class="tw-text-xs md:tw-text-sm">{{ $trip->metaDescription() }}</div>
        </div>
      </a>
    </div>
  @endforeach
</div>
@endsection
