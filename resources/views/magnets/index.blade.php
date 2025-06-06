@extends('magnets.base')
@include('livewire')

@section('content')
<div class="flex">
  <aside class="hidden lg:block shrink-0 w-56">
    <div class="lg:sticky lg:top-4">
      <nav>
        @foreach ($tree as $id => $category)
          <h4 class="font-medium text-xl mb-1 {{ $loop->first ? '' : 'mt-6' }} whitespace-nowrap">
            @if (!empty($categoryId) && $id == $categoryId)
              <mark>{{ $category['title'] }}</mark>
            @else
              <a class="visited" href="{{ to('magnets', ['category_id' => $id, 'q' => $q]) }}">{{ $category['title'] }}</a>
            @endif
          </h4>
          @if (!empty($category['children']))
            @foreach ($category['children'] as $childId => $child)
              @continue (empty($stats[$childId]))
              <div class="whitespace-nowrap">
                @if (!empty($categoryId) && $childId == $categoryId)
                  <mark>{{ $child['title'] }}</mark>
                @else
                  <a
                    class="visited"
                    href="{{ to('magnets', ['category_id' => $childId, 'q' => $q]) }}"
                  >{{ $child['title'] }}</a>
                @endif
                <span class="text-gray-500 text-xs">{{ $stats[$childId] }}</span>
              </div>
            @endforeach
          @endif
        @endforeach
      </nav>
      @guest
        @ru
          <div class="mt-6 mr-6 p-2 text-xs text-teal-800 dark:text-teal-400/75 bg-teal-200/50 dark:bg-teal-400/25 border border-teal-200/50 dark:border-teal-200/15 rounded-sm">
            <a class="link" href="{{ path([App\Http\Controllers\Auth\SignIn::class, 'index'], ['goto' => path([App\Http\Controllers\MagnetsController::class, 'index'])]) }}">Пользователям</a> доступен чат
          </div>
        @endru
      @endguest
    </div>
  </aside>
  <div class="grow">
    @if (Auth::check() && empty(request()->query()))
      @livewire(App\Livewire\Chat::class)
    @endif
    @if ($q)
      @ru
        <div class="font-medium text-2xl mb-2">Результаты поиска по запросу «{{ $q }}»</div>
      @en
        <div class="font-medium text-2xl mb-2">Search results for «{{ $q }}»</div>
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
        <a class="btn btn-primary" href="{{ App\Magnet::externalSearchLink($q) }}">
          Искать на рутрекере
          @svg (external-link)
        </a>
      </div>
    @endif
    <?php $lastDate = null ?>
    @if (count($magnets))
      <?php /** @var App\Magnet $magnet */ ?>
      @foreach ($magnets as $magnet)
        @if (null === $lastDate || !$magnet->registered_at->isSameDay($lastDate))
          <div class="font-medium mb-2 {{ $loop->first ? 'mt-0' : 'mt-6' }}">{{ $magnet->fullDate() }}</div>
          <?php $lastDate = $magnet->registered_at ?>
        @endif
        <div class="flex flex-wrap md:flex-nowrap justify-center md:justify-start magnets-list-container hover:bg-[#f6f6f6] dark:hover:bg-slate-800 js-magnets-views-observer" data-id="{{ $magnet->id }}">
          <div class="shrink-0 w-8 magnet-icon order-1 md:order-none mr-1 md:text-2xl" title="{{ $magnet->category_id->title() }}">
            <?php $icon = $magnet->category_id->icon() ?>
            @svg ($icon)
          </div>
          <a class="grow mb-2 md:mb-0 md:mr-4 visited" href="{{ $magnet->www() }}">
            @if (Auth::user()?->magnet_short_title)
              <div>{{ $magnet->shortTitle() }}</div>
            @else
              <div class="font-bold">
                <x-magnet-title>{{ $magnet->title }}</x-magnet-title>
              </div>
            @endif
          </a>
          <a
            class="shrink-0 pr-2 magnets-list-magnet text-center md:text-left whitespace-nowrap js-magnet"
            href="{{ $magnet->magnet() }}"
            title="@lang('Магнет')"
            data-action="{{ to('magnets/{magnet}/magnet', $magnet) }}"
          >
            @svg (magnet)
            <span class="js-magnet-counter">{{ $magnet->clicks ?: '' }}</span>
          </a>
          <div class="shrink-0 text-center md:text-left whitespace-nowrap magnets-list-size">{{ ViewHelper::size($magnet->size) }}</div>
        </div>
      @endforeach

      @include('tpl.paginator', ['paginator' => $magnets, 'cloak' => true])
    @else
      <div class="mb-4 py-3 px-5 text-yellow-800/75 dark:text-yellow-400/75 bg-yellow-300/25 dark:bg-yellow-400/25 border border-yellow-200 dark:border-yellow-300/25 rounded-sm">
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
        <ul class="text-gray-500 mb-4">
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
        <ul class="text-gray-500 mb-4">
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
        <div class="mt-2 mb-6">Мы можем помочь с поиском. Расскажите как можно подробнее что вы ищете. Мы постараемся добавить раздачу в течение суток, однако вы можете самостоятельно продолжить поиск по <a class="link" href="{{ App\Magnet::externalSearchLink($q) }}">рутрекеру</a> и затем <a class="link" href="/magnets/add">поделиться находкой</a> с остальными пользователями.</div>

        <form action="@lng/magnets/request" method="post">
          {{ ViewHelper::inputHiddenMail() }}
          @csrf

          <div class="mb-4">
            <label class="font-bold">Поисковый запрос</label>
            <input
              required
              class="the-input"
              type="text"
              name="query"
              value="{{ old('query', $q) }}"
            >
            <x-invalid-feedback field="query"/>
          </div>

          <div class="mb-4">
            <label class="font-bold">Комментарий</label>
            <textarea
              class="the-input"
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
