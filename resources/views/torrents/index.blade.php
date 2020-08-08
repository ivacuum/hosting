@extends('torrents.base')
@include('livewire')

@section('content')
<div class="flex">
  <aside class="hidden lg:block flex-shrink-0 antialiased torrent-categories w-56">
    <div class="lg:sticky lg:top-4">
      <nav>
        @foreach ($tree as $id => $category)
          <h4 class="{{ $loop->first ? '' : 'mt-6' }} whitespace-no-wrap">
            @if (!empty($categoryId) && $id == $categoryId)
              <mark>{{ $category['title'] }}</mark>
            @else
              <a class="visited" href="{{ path([$controller, 'index'], ['category_id' => $id]) }}">{{ $category['title'] }}</a>
            @endif
          </h4>
          @if (!empty($category['children']))
            @foreach ($category['children'] as $id => $child)
              @continue (empty($stats[$id]))
              <div class="whitespace-no-wrap">
                @if (!empty($categoryId) && $id == $categoryId)
                  <mark>{{ $child['title'] }}</mark>
                @else
                  <a
                    class="visited"
                    href="{{ path([App\Http\Controllers\Torrents::class, 'index'], ['category_id' => $id]) }}"
                  >{{ $child['title'] }}</a>
                @endif
                <span class="text-muted text-xs">{{ $stats[$id] }}</span>
              </div>
            @endforeach
          @endif
        @endforeach
      </nav>
      @guest
        @ru
          <div class="mt-6 mr-6 p-2 text-xs text-teal-800 bg-teal-200 bg-opacity-50 border border-teal-200 rounded">
            <a class="link" href="{{ path([App\Http\Controllers\Auth\SignIn::class, 'index'], ['goto' => path([App\Http\Controllers\Torrents::class, 'index'])]) }}">Пользователям</a> доступны чат и добавление раздач
          </div>
        @endru
      @endguest
    </div>
  </aside>
  <div class="flex-grow" v-cloak>
    @if (Auth::check() && empty(request()->query()))
      @livewire(App\Http\Livewire\Chat::class)
    @endif
    @if ($q)
      @ru
        <div class="h3">Результаты поиска по запросу «{{ $q }}»</div>
      @en
        <div class="h3">Search results for «{{ $q }}»</div>
      @endru
      <div class="mb-6">
        @if ($fulltext)
          <a class="btn btn-default" href="{{ UrlHelper::filter(['fulltext' => null]) }}">
            <span class="text-red-600">
              @svg (times)
            </span>
            Искать только в заголовках
          </a>
        @else
          <a class="btn btn-default" href="{{ UrlHelper::filter(['fulltext' => 1]) }}">
            @svg (search)
            Искать в описаниях раздач
          </a>
        @endif
        <a class="btn btn-primary" href="{{ App\Torrent::externalSearchLink($q) }}">
          Искать на рутрекере
          @svg (external-link)
        </a>
      </div>
    @endif
    <?php $lastDate = null ?>
    @if (sizeof($torrents))
      <?php /** @var App\Torrent $torrent */ ?>
      @foreach ($torrents as $torrent)
        @if (null === $lastDate || !$torrent->registered_at->isSameDay($lastDate))
          <h6 class="{{ $loop->first ? 'mt-0' : 'mt-6' }}">{{ $torrent->fullDate() }}</h6>
          <?php $lastDate = $torrent->registered_at ?>
        @endif
        <?php $category = TorrentCategoryHelper::find($torrent->category_id) ?>
        <div class="flex flex-wrap md:flex-no-wrap justify-center md:justify-start torrents-list-container antialiased js-torrents-views-observer" data-id="{{ $torrent->id }}">
          <div class="flex-shrink-0 w-8 torrent-icon order-1 md:order-none mr-1 md:text-2xl" title="{{ $category['title'] }}">
            <?php $icon = $category['icon'] ?? 'file-text-o' ?>
            @svg ($icon)
          </div>
          <a class="flex-grow mb-2 md:mb-0 md:mr-4 visited" href="{{ $torrent->www() }}">
            @if (optional(Auth::user())->torrent_short_title)
              <div>{{ $torrent->shortTitle() }}</div>
            @else
              <div class="font-bold">
                <x-magnet-title>{{ $torrent->title }}</x-magnet-title>
              </div>
            @endif
          </a>
          <a class="flex-shrink-0 pr-2 torrents-list-magnet text-center md:text-left whitespace-no-wrap js-magnet"
             href="{{ $torrent->magnet() }}"
             title="{{ __('Скачать') }}"
             data-action="{{ path([App\Http\Controllers\Torrents::class, 'magnet'], $torrent) }}"
          >
            @svg (magnet)
            <span class="js-magnet-counter">{{ $torrent->clicks ?: '' }}</span>
          </a>
          <div class="flex-shrink-0 text-center md:text-left whitespace-no-wrap torrents-list-size">{{ ViewHelper::size($torrent->size) }}</div>
        </div>
      @endforeach

      @include('tpl.paginator', ['paginator' => $torrents, 'cloak' => true])
    @else
      <div class="mb-4 py-3 px-5 text-yellow-800 bg-yellow-300 bg-opacity-25 text-opacity-75 border border-yellow-200 rounded">
        Подходящих раздач не найдено.
        @if (!$fulltext)
          Можно расширить область поиска с помощью кнопки выше.
        @endif
      </div>
    @endif
    @if ($q)
      <details class="mt-4">
        <summary>Как пользоваться поиском?</summary>
        <div class="mt-2 mb-1">Поиск по раздачам учитывает морфологию русского языка, поэтому «комедия» найдется даже при запросе «комедии». Ниже приведены примеры запросов для понимания особенностей поиска:</div>
        <ul class="text-muted mb-4">
          <li>
            <a href="{{ UrlHelper::filter(['q' => 'драма']) }}">драма</a>
            — кинематограф соответствующей тематики
          </li>
          <li>
            <a href="{{ UrlHelper::filter(['q' => 'фантастика 2017']) }}">фантастика 2017</a>
            — поиск по теме за 2017 год, порядок слов значения не имеет
          </li>
          <li>
            <a href="{{ UrlHelper::filter(['q' => 'россия']) }}">россия</a>
            — раздачи российского происхождения
          </li>
          <li>
            <a href="{{ UrlHelper::filter(['q' => '1080p']) }}">1080p</a>
            — Full HD качество
          </li>
          <li>
            <a href="{{ UrlHelper::filter(['q' => 'original']) }}">original</a>
            — только с оригинальной озвучкой
          </li>
          <li>
            <a href="{{ UrlHelper::filter(['q' => 'dub']) }}">dub</a>
            — дубляж
          </li>
          <li>
            <a href="{{ UrlHelper::filter(['q' => 'sub']) }}">sub</a>
            — с субтитрами
          </li>
          <li>
            <a href="{{ UrlHelper::filter(['q' => 'мост 3 сезон']) }}">мост 3 сезон</a>
            — поиск отдельного сезона сериала
          </li>
        </ul>
        <div class="mb-1">Изначально поиск выполняется только по заголовкам раздач. Но его область можно расширить и до их описаний с помощью клика по соответствующей кнопке перед результатами поиска. Это позволяет находить фильмы по актерам, отдельные игры в раздачах антологий и т.п. Примеры:</div>
        <ul class="text-muted mb-4">
          <li>
            <a href="{{ UrlHelper::filter(['q' => 'мэтт дэймон', 'fulltext' => 1]) }}">мэтт дэймон</a>
            — кино с актером
          </li>
          <li>
            <a href="{{ UrlHelper::filter(['q' => 'кубок огня', 'fulltext' => 1]) }}">кубок огня</a>
            — отдельная часть Гарри Поттера в антологии
          </li>
          <li>
            <a href="{{ UrlHelper::filter(['q' => 'nfs underground', 'fulltext' => 1]) }}">nfs underground</a>
            — отдельная часть игры в антологии
          </li>
        </ul>
        <p>Как можно было заметить из примеров, порядок слов в запросе не имеет значения. Поэтому, поиск найдет сериал «мир дикого запада» даже при запросе «мир запада» или «запада дикого».</p>
        <p>Однако, поиск не умеет переводить слова, поэтому «office» может не найтись по запросу «офис». Тоже самое касается и пары запросов «фифа» и «fifa». В связи с этим рекомендуется пробовать разные варианты написания.</p>
      </details>

      <details class="mt-4">
        <summary>Не нашли искомую раздачу? Оставьте нам запрос</summary>
        <div class="mt-2 mb-6">Мы можем помочь с поиском. Расскажите как можно подробнее что вы ищете. Мы постараемся добавить раздачу в течение суток, однако вы можете самостоятельно продолжить поиск по <a class="link" href="{{ App\Torrent::externalSearchLink($q) }}">рутрекеру</a> и затем <a class="link" href="/torrents/add">поделиться находкой</a> с остальными пользователями.</div>

        <form action="{{ path(App\Http\Controllers\TorrentRequestRelease::class) }}" method="post">
          {{ ViewHelper::inputHiddenMail() }}
          @csrf

          <div class="mb-4">
            <label class="font-bold">Поисковый запрос</label>
            <input
              required
              class="form-input"
              name="query"
              value="{{ old('query', $q) }}"
            >
            <x-invalid-feedback field="query"/>
          </div>

          <div class="mb-4">
            <label class="font-bold">Комментарий</label>
            <textarea
              class="form-textarea"
              rows="4"
              name="comment"
            ></textarea>
          </div>

          <button class="btn btn-primary">Отправить запрос</button>
        </form>
      </details>
    @endif
  </div>
</div>
@endsection
