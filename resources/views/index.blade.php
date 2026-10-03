<?php
/**
 * @var \App\Domain\Life\Models\Trip $trip
 * @var \App\Domain\Game\Models\Game $game
 */
?>

@extends('base')

@section('content')
<h1 class="font-semibold text-lg md:hidden mb-6">
  @ru Сергей Панков @en Sergei Pankov @endru
  <span class="text-gray-500 single-story-a">
    &middot;
    vacuum kaluga
  </span>
</h1>

<div class="grid md:grid-cols-2 lg:grid-cols-3 gap-12 md:gap-6 mb-12 md:mb-8">
  @ru
    <div class="hidden md:block">
      <a class="flex gap-2 items-center mb-2 link-parent" href="@lng/magnets">
        <div class="leading-none text-3xl">🧲</div>
        <h2 class="font-semibold text-2xl"><span class="link">@lang('Магнеты')</span></h2>
      </a>
      <div>Сервис для скачивания файлов у многочисленных пользователей сети интернет без регистрации и рейтинга.</div>
      {{--<div class="text-gray-500">Дата запуска: 5 января 2017 г.</div>--}}
    </div>
  @endru
  <div>
    <a class="flex gap-2 items-center mb-2 link-parent" href="@lng/life">
      <div class="leading-none text-3xl">📝</div>
      <h2 class="font-semibold text-2xl"><span class="link">@lang('Заметки')</span></h2>
    </a>
    @ru
      <div>Мои заметки о жизни: поездки по городам России и мира, посещенные концерты, понравившиеся фильмы и книги.</div>
      {{--<div class="text-gray-500 hidden md:block">Дата запуска: 29 сентября 2014 г.</div>--}}
    @en
      <div>Notes about my life. Trips around Russia and the whole world. Attended gigs. Favorite movies and books.</div>
    @endru
  </div>
  @ru
    <div class="md:hidden">
      <a class="flex items-center mb-2 link-parent" href="@lng/news">
        <h2 class="font-semibold text-2xl"><span class="link">@lang('Новости')</span></h2>
      </a>
      <div>Хроника развития сайта с 2004 года.</div>
    </div>
    {{--
    <div class="hidden md:block">
      <a class="flex items-center mb-2 link-parent" href="https://kupislona.ru/">
        <h2 class="font-semibold text-2xl"><span class="link">KupiSlona.ru</span></h2>
      </a>
      <div>Доска бесплатных объявлений России. Место встречи продавцов и покупателей.</div>
      {{--<div class="text-gray-500">Дата запуска: 7 декабря 2015 г.</div>--}}
    {{--</div>--}}
    <div class="hidden md:block">
      <a class="flex items-center mb-2 link-parent" href="@lng/gallery">
        <h2 class="font-semibold text-2xl"><span class="link">@lang('Галерея')</span></h2>
      </a>
      <div>Хранилище изображений для последующей публикации в интернете.</div>
      {{--<p class="text-gray-500">Дата запуска: 8 февраля 2009 г.</p>--}}
    </div>
  @endru
  <div class="hidden md:block">
    <a class="flex items-center mb-2 link-parent" href="@lng/dc">
      <h2 class="font-semibold text-2xl"><span class="link">ArtFly.DC++</span></h2>
    </a>
    @ru
      <div>Большая коллекция русских DC++ клиентов. Ответы на вопросы. Популярные хабы.</div>
      {{--<p class="text-gray-500">Дата запуска: 17 марта 2008 г.</p>--}}
    @en
      <p>Large collection of DC++ client software. Popular hubs to connect.</p>
    @endru
  </div>
  @ru
    <div class="hidden md:block">
      <a class="flex items-center mb-2 link-parent" href="http://t.ivacuum.ru">
        <h2 class="font-semibold text-2xl"><span class="link">@lang('Торренты')</span></h2>
      </a>
      <div>Исторический форум сервиса для обмена файлами внутри локальной сети Билайн.</div>
      {{--<p class="text-gray-500">Дата запуска: 5 июля 2010 г.</p>--}}
    </div>
  @endru
  <div>
    <a class="flex gap-2 items-center mb-2 link-parent" href="@lng/trainers">
      <h2 class="font-semibold text-2xl"><span class="link">@lang('Тренажеры')</span></h2>
    </a>
    <div>@lang('Интерактивные инструменты для практики иностранных языков.')</div>
  </div>
  <div>
    <a class="flex gap-2 items-center mb-2 link-parent" href="@lng/promocodes-coupons">
      <div class="leading-none text-3xl">🎁</div>
      <h2 class="font-semibold text-2xl"><span class="link">@lang('Промокоды и купоны')</span></h2>
    </a>
    @ru
      <div>Коллекция способов сэкономить на услугах известных сервисов.</div>
      {{--<div class="text-gray-500">Дата запуска: 25 февраля 2017 г.</div>--}}
    @en
      <div>Easy ways to get discounts for well known services.</div>
    @endru
  </div>
  <div>
    <a class="flex gap-2 items-center mb-2 link-parent" href="@lng/japanese">
      <div class="leading-none text-3xl">🇯🇵</div>
      <h2 class="font-semibold text-2xl"><span class="link">@lang('Японский язык')</span></h2>
    </a>
    @ru
      <div>Тренажер для запоминания слоговых азбук. Набор ключей, кандзи и словарных слов для самостоятельного изучения и повторения.</div>
    @en
      <div>Hiragana & Katakana trainer. Set of radicals, kanji and vocabulary to learn and review.</div>
    @endru
  </div>
  @ru
    <div>
      <a class="flex gap-2 items-center mb-2 link-parent" href="@lng/korean">
        <div class="leading-none text-3xl">🇰🇷</div>
        <h2 class="font-semibold text-2xl"><span class="link">@lang('Корейский язык')</span></h2>
      </a>
      @ru
        <div>Тренажер для запоминания корейского алфавита. Кириллизация песен Сая.</div>
      @en
        <div>Hangul trainer. PSY song lyrics.</div>
      @endru
    </div>
  @endru
</div>

<h3 class="font-semibold text-2xl mb-2">
  <a class="link" href="@lng/life">
    @ru Истории о путешествиях @en Travel stories @endru
  </a>
</h3>

<div class="grid md:grid-cols-2 lg:grid-cols-3 -mx-4 sm:mx-0">
  @foreach ($trips as $trip)
    <div class="relative">
      <a class="block group" href="{{ $trip->www() }}">
        <div class="relative pb-[75%]">
          <img
            class="absolute w-full h-full object-cover bg-gray-700 brightness-3/4 group-hover:brightness-full"
            src="{{ $trip->metaImage(500, 375) }}"
            alt=""
            loading="lazy"
          >
        </div>
        <div class="absolute bottom-0 text-white trip-cover-info p-4 w-full">
          <div class="flex flex-wrap gap-1 items-center text-lg">
            <img class="flag-24 svg-shadow" src="{{ $trip->city->country->flagUrl() }}" alt="" loading="lazy">
            <span class="leading-none">{{ $trip->title }}</span>
            <span class="leading-tight self-end text-gray-300 text-xs">{{ $trip->timelinePeriodWithYear() }}</span>
          </div>
          @if ($trip->metaDescription())
            <div class="leading-tight mt-1 text-xs md:text-2sm">{{ $trip->metaDescription() }}</div>
          @endif
        </div>
      </a>
    </div>
  @endforeach
</div>

<h3 class="font-semibold text-2xl mb-2 mt-12">
  <a class="link" href="@lng/games">
    @ru Игры @en Games @endru
  </a>
</h3>
@ru
  <p>Мысли и скриншоты о попробованных и пройденных играх.</p>
@en
  <p>Thoughts and screenshots about games I've tried or beaten.</p>
@endru

<div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-6 mb-8">
  @foreach($games as $game)
    <div>
      <a class="screenshot-link link-parent" href="@lng/games/{{ $game->slug }}">
        <img class="block screenshot aspect-2/3" src="{{ $game->libraryImage() }}" alt="" loading="lazy">
        <div class="mt-1 link">{{ $game->title }}</div>
      </a>
    </div>
  @endforeach
</div>
@endsection
