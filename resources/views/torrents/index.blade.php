@extends('torrents.base', [
  'websockets' => Auth::check() && empty(request()->query()),
])

@section('content')
<div class="tw-flex">
  <aside class="tw-hidden lg:tw-block tw-flex-shrink-0 tw-antialiased torrent-categories tw-w-56">
    <nav>
      @foreach ($tree as $id => $category)
        <h4 class="{{ $loop->first ? '' : 'tw-mt-6' }} tw-whitespace-no-wrap">
          @if (!empty($category_id) && $id == $category_id)
            <mark>{{ $category['title'] }}</mark>
          @else
            <a class="visited" href="{{ path("$self@index", ['category_id' => $id]) }}">{{ $category['title'] }}</a>
          @endif
        </h4>
        @if (!empty($category['children']))
          @foreach ($category['children'] as $id => $child)
            @continue (empty($stats[$id]))
            <div class="tw-whitespace-no-wrap">
              @if (!empty($category_id) && $id == $category_id)
                <mark>{{ $child['title'] }}</mark>
              @else
                <a class="visited" href="{{ path("$self@index", ['category_id' => $id]) }}">{{ $child['title'] }}</a>
              @endif
              <span class="text-muted f13">{{ $stats[$id] }}</span>
            </div>
          @endforeach
        @endif
      @endforeach
    </nav>
    @guest
      @ru
        <div class="alert alert-info tw-mr-6 tw-mt-6 tw-p-2 small">
          <a class="link" href="{{ path('Auth\SignIn@index', ['goto' => path('Torrents@index')]) }}">Пользователям</a> доступны чат и добавление раздач
        </div>
      @endru
    @endguest
  </aside>
  <div class="tw-flex-grow" v-cloak>
    @if (Auth::check() && empty(request()->query()))
      <chat></chat>
    @endif
    @if ($q)
      @ru
        <div class="h3">Результаты поиска по запросу «{{ $q }}»</div>
      @en
        <div class="h3">Search results for «{{ $q }}»</div>
      @endru
      @if ($fulltext)
        <div class="tw-mb-6">
          <a class="btn btn-default" href="{{ UrlHelper::filter(['fulltext' => null]) }}">
            <span class="tw-text-red-600">
              @svg (times)
            </span>
            Искать только в заголовках
          </a>
        </div>
      @else
        <div class="tw-mb-6">
          <a class="btn btn-default" href="{{ UrlHelper::filter(['fulltext' => 1]) }}">
            @svg (search)
            Искать в описаниях раздач
          </a>
        </div>
      @endif
    @endif
    @php ($last_date = null)
    @if (sizeof($torrents))
      @foreach ($torrents as $torrent)
        @if (null === $last_date || !$torrent->registered_at->isSameDay($last_date))
          <h6 class="{{ $loop->first ? 'tw-mt-0' : 'tw-mt-6' }}">{{ $torrent->fullDate() }}</h6>
          @php ($last_date = $torrent->registered_at)
        @endif
        @php ($category = TorrentCategoryHelper::find($torrent->category_id))
        <div class="tw-flex tw-flex-wrap md:tw-flex-no-wrap tw-justify-center md:tw-justify-start torrents-list-container tw-antialiased js-torrents-views-observer" data-id="{{ $torrent->id }}">
          <div class="tw-flex-shrink-0 torrents-list-icon torrent-icon order-1 order-md-0" title="{{ $category['title'] }}">
            @php ($icon = $category['icon'] ?? 'file-text-o')
            @svg ($icon)
          </div>
          <a class="tw-flex-grow tw-mb-2 md:tw-mb-0 md:tw-mr-4 visited" href="{{ $torrent->www() }}">
            <torrent-title title="{{ $torrent->title }}" hide_brackets="{{ Auth::check() && Auth::user()->torrent_short_title ? 1 : '' }}"></torrent-title>
          </a>
          <a class="tw-flex-shrink-0 tw-pr-2 torrents-list-magnet tw-text-center md:tw-text-left tw-whitespace-no-wrap js-magnet"
             href="{{ $torrent->magnet() }}"
             title="{{ trans('torrents.download') }}"
             data-action="{{ path('Torrents@magnet', $torrent) }}"
          >
            @svg (magnet)
            <span class="js-magnet-counter">{{ $torrent->clicks > 0 ? $torrent->clicks : '' }}</span>
          </a>
          <div class="tw-flex-shrink-0 tw-text-center md:tw-text-left tw-whitespace-no-wrap torrents-list-size">{{ ViewHelper::size($torrent->size) }}</div>
        </div>
      @endforeach

      @include('tpl.paginator', ['paginator' => $torrents, 'cloak' => true])
    @else
      <p class="alert alert-warning">
        Подходящих раздач не найдено.
        @if (!$fulltext)
          Можно расширить область поиска с помощью кнопки выше.
        @endif
      </p>

      @if ($q)
        <details>
          <summary>Как пользоваться поиском?</summary>
          <div class="tw-mt-2 tw-mb-1">Поиск по раздачам учитывает морфологию русского языка, поэтому «комедия» найдется даже при запросе «комедии». Ниже приведены примеры запросов для понимания особенностей поиска:</div>
          <ul class="text-muted">
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
          <div class="tw-mb-1">Изначально поиск выполняется только по заголовкам раздач. Но его область можно расширить и до их описаний с помощью клика по соответствующей кнопке перед результатами поиска. Это позволяет находить фильмы по актерам, отдельные игры в раздачах антологий и т.п. Примеры:</div>
          <ul class="text-muted">
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
      @endif
    @endif
  </div>
</div>
@endsection
