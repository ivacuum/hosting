@php($locale = app()->getLocale())
<!DOCTYPE html>
<html lang="{{ $locale }}" prefix="og: http://ogp.me/ns#">
<head>
  <meta charset="utf-8">
  <title>@ru Сергей Панков &middot; Резюме &middot; Веб-программист (Laravel PHP, Vue.js) @en Sergei Pankov &middot; CV &middot; Laravel PHP + Vue.js Developer @endru</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="robots" content="noindex, nofollow">
  @vite('resources/css/app.css')

  <meta content="summary" property="twitter:card">
  <meta content="@knifevacuum" property="twitter:site">
  <meta content="252045193" property="twitter:site:id">
  <meta content="206702146011627" property="fb:app_id">
  <meta content="100001136135534" property="fb:admins">
  <meta content="profile" property="og:type">
  <meta content="@ru Сергей Панков &middot; Резюме &middot; Веб-программист (Laravel PHP, Vue.js) @en Sergei Pankov &middot; CV &middot; Laravel PHP + Vue.js Developer @endru" property="og:title">
  <meta content="{{ canonical() }}" property="og:url">
  <meta content="https://life.ivacuum.org/me.jpg" property="og:image">
  <meta content="@ru Веб-программист (Laravel PHP, Vue.js). Заинтересован в создании полезных людям веб-сервисов. Веб-технологиями увлекаюсь с 2003 года. С кодом моих проектов можно ознакомиться на Гитхабе. Только удаленная работа. @en Laravel PHP + Vue.js Developer. Only remote work. @endru" property="og:description">
  <meta content="@ru Сергей @en Sergei @endru" property="profile:first_name">
  <meta content="@ru Панков @en Pankov @endru" property="profile:last_name">
  <meta content="male" property="profile:gender">
  <meta content="vacuum" property="profile:username">
<style>
body {
  background-color: #a1a1a1;
  color: #4b4b4b;
}

.wrapper { box-shadow: 0 1px 6px rgba(0, 0, 0, .30), 0 0 2.5rem rgba(0, 0, 0, .10) inset; }

.my-picture {
  border: 1px solid rgba(0, 0, 0, .2);
  box-shadow: 0 1px 3px rgba(0, 0, 0, .1);
}

.my-caption {
  border-bottom: 1px solid #2c7a7b;
  color: #2c7a7b;
  padding-bottom: .25rem;
}

.portfolio-year {
  border-bottom: 1px solid #dedede;
  color: #6c757d;
  padding-bottom: .25rem;
  padding-top: .25rem;
  margin-top: 2rem;
  position: sticky;
  top: 0;
  background: #fff;
}
</style>
</head>
<body class="lg:pt-4 lg:pb-8">
<div class="mx-auto max-w-4xl wrapper bg-white p-4 sm:p-6 lg:p-8">
  <div class="grid md:grid-cols-3 gap-8">
    <div class="md:col-span-2">
      <div class="sm:flex mb-6">
        <div class="mb-2 sm:mb-0">
          <img class="my-picture bg-white mr-4 p-1 w-32 h-32 max-w-none" src="https://life.ivacuum.org/me.jpg" alt="">
        </div>
        <div>
          <h1 class="text-2xl font-semibold tracking-tight uppercase">@ru Сергей Панков @en Sergei Pankov @endru</h1>
          <h2 class="font-medium text-xl mb-2 text-teal-600">@ru Веб-программист (Laravel PHP, Vue.js) @en Laravel PHP + Vue.js Developer @endru</h2>
          @ru
            <div>Заинтересован в создании полезных людям веб-сервисов. Веб-технологиями увлекаюсь с 2003 года. С кодом моих проектов можно ознакомиться на <a href="https://github.com/ivacuum" rel="nofollow">Гитхабе</a>. Только удаленная работа.</div>
          @en
            <div>Interested in making useful web-services. Passionated about the web since 2003. My code is available on <a href="https://github.com/ivacuum" rel="nofollow">GitHub</a>. Only remote work.</div>
          @endru
        </div>
      </div>
      <div class="grid md:grid-cols-2 gap-8">
        <div>
          <h3 class="my-caption font-medium text-lg mb-2 text-teal-500 uppercase">@ru Образование @en Education @endru</h3>
          <div class="font-bold">@ru Высшее, МГТУ им. Баумана @en Bauman Moscow State Technical University @endru</div>
          <div>
            @ru Инженер-программист @en IT Engineer's degree @endru
            <span class="text-xs text-muted">2006–2012</span>
          </div>
          <h3 class="my-caption font-medium text-lg mb-2 mt-6 sm:mt-12 uppercase">@ru Курсы и тренинги @en Courses & Trainings @endru</h3>
          <div class="font-bold">@ru Английский язык @en English @endru</div>
          <div>
            @ru Грамматика @en Grammar @endru
            <span class="text-xs text-muted">2006</span>
          </div>
          <div>
            @ru Разговорный @en Spoken @endru
            <span class="text-xs text-muted">2011</span>
          </div>
        </div>
        <div>
          <h3 class="my-caption font-medium text-lg mb-2 uppercase">@ru Опыт работы @en Experience @endru</h3>
          <div>@ru 01.12.2014 — по настоящее время @en Dec 2014 — Present @endru</div>
          <div>@ru ООО Гала Маркетинг @en OOO Gala Marketing @endru</div>
          <div>@ru Технический директор @en CTO @endru</div>

          <div class="mt-6">@ru 18.11.2013 — 11.03.2014 @en Nov 2013 — Mar 2014 @endru</div>
          <div><a href="https://www.smart-media.ru/" rel="nofollow">@ru ООО МедиаКонтент @en OOO MediaContent @endru</a></div>
          <div>@ru Ведущий разработчик (тимлид) @en Lead Developer (Team Lead) @endru</div>

          <div class="mt-6">@ru 10.09.2007 &mdash; 31.05.2013 @en Sep 2007 — May 2013 @endru</div>
          <div><a href="https://www.korden.ru/" rel="nofollow">@ru ООО Корден @en OOO Korden @endru</a></div>
          <div>@ru Веб-программист @en PHP Developer @endru</div>
        </div>
      </div>
    </div>
    <div>
      <h3 class="my-caption tracking-tight font-medium text-lg mb-2 uppercase">@ru Контактная информация @en Contacts @endru</h3>
      <div class="flex justify-between">
        <div>@ru Телефон @en Phone @endru</div>
        <div><a href="tel:+79105141181">+7 910 514-1181</a></div>
      </div>
      <div class="flex justify-between">
        <div>@ru Электропочта @en E-mail @endru</div>
        <div><a href="mailto:me@ivacuum.ru">me@ivacuum.ru</a></div>
      </div>
      <div class="flex justify-between">
        <div>@ru Веб-сайт @en Website @endru</div>
        <div><a href="/">vacuum.name</a></div>
      </div>

      <h3 class="my-caption font-medium text-lg mb-2 mt-6 uppercase">@ru Личная информация @en Personal info @endru</h3>
      <div class="flex justify-between">
        <div>@ru Возраст @en Age @endru</div>
        <div>{{ \Carbon\CarbonImmutable::createFromDate(1989, 7, 13)->diffForHumans(null, true) }} @ru @en old @endru</div>
      </div>
      <div class="flex justify-between">
        <div>@ru Гражданство @en Nationality @endru</div>
        <div>@ru Россия @en Russian @endru</div>
      </div>
      <div class="flex justify-between">
        <div>@ru Проживание @en Based in @endru</div>
        <div>@ru Калуга @en Kaluga @endru</div>
      </div>
      <div class="flex justify-between">
        <div>@ru Семейное положение @en Marital status @endru</div>
        <div>@ru Не женат @en Single @endru</div>
      </div>
      <div class="flex justify-between">
        <div>@ru Дети @en Children @endru</div>
        <div>@ru Нет @en No @endru</div>
      </div>

      <h3 class="my-caption font-medium text-lg mb-2 mt-6 uppercase">@ru В сети @en Online @endru</h3>
      <div class="flex flex-col">
        <a href="https://github.com/ivacuum" rel="nofollow">GitHub</a>
        {{--<a href="skype:knifevacuum?call" rel="nofollow">Skype</a>--}}
        <a href="https://t.me/vacuum" rel="nofollow">Telegram</a>
        <a href="https://vk.com/ivacuum" rel="nofollow">VK</a>
      </div>
    </div>
  </div>

  <div class="my-caption font-medium text-2xl mb-2 mt-12 uppercase">@ru О себе @en About me @endru</div>
  @ru
    <p>Более половины своей жизни увлекаюсь созданием сайтов и в целом полезных сервисов. Всегда нравился английский язык, впоследствии обнаружил интерес и к другим иностранным языкам. В свободное время играю на электрогитаре, смотрю кинематограф в оригинале (даже если это датский — английские субтитры все равно найдутся) и катаюсь на велосипеде. Посещаю музыкальные концерты.</p>
  @en
    <p>More than half of my life I develop websites and useful services in general. I've always loved English. At some point, I found I'm interested in other foreign languages, too. In my free time, I play my electric guitars, watch movies and TV shows in original voice acting (even if it's Danish there are always English subtitles), and ride my bicycle. I attend music concerts.</p>
  @endru

  @ru
    <p>С 2016 года активно путешествую, работая из разных уголков мира. Поездки тщательно документирую и затем публикую о них <a href="/life">заметки с фотографиями</a>. Примерно треть материала перевел на английский язык. Также делюсь опытом бюджетных поездок.</p>
  @en
    <p>Travel a lot since 2016, work remotely as a result. I document my trips and then publish <a href="/en/life">notes with photos</a> in Russian. I've translated one-third of them into English. I also share tips on how to do budget trips.</p>
  @endru

  @ru
    <p>Рассматриваю только варианты удаленной занятости. Не готов к релокации, так как она не даст смотреть мир. Но готов иногда заезжать в гости.</p>
  @en
    <p>I'm considering only remote employment. Not ready for relocation because it won't allow me to see the different parts of the world. But I'm ready to meet occasionally.</p>
  @endru

  <div class="my-caption font-medium text-2xl mb-2 mt-12 uppercase">@ru Навыки @en Skills @endru</div>
  <div class="text-teal-500 font-medium text-lg mb-2">@ru Операционные системы @en Operating systems @endru</div>
  @ru
    <p>Опыт использования <strong>Windows</strong> и <strong>macOS</strong>, настраивал серверы под управлением <strong>Linux</strong> и <strong>FreeBSD</strong>. Повседневно использую <strong>macOS</strong>.</p>
  @en
    <p>Experienced in <strong>Windows</strong> and <strong>macOS</strong>, set up servers running <strong>Linux</strong> and <strong>FreeBSD</strong>. I use <strong>macOS</strong> on a daily basis.</p>
  @endru

  <div class="text-teal-500 font-medium text-lg mb-2 mt-6">@ru Языки программирования @en Programming languages @endru</div>
  <ul>
    <li class="mb-2">
      <strong>PHP</strong>
      @ru
        — сделал множество сайтов и сервисов c 2003 года по настоящее время.
      @en
        — built many websites since 2003.
      @endru
    </li>
    <li class="mb-2">
      <strong>Perl</strong>
      @ru
        — написал пять event-driven приложений для эффективной обработки большого количества поступающих сообщений.
      @en
        — built five event-driven applications to effectively parse lots of incoming messages.
      @endru
    </li>
    <li>
      <strong>Javascript</strong>
      @ru
        — фронтэнд множества сайтов.
      @en
        — frontend of many websites.
      @endru
    </li>
  </ul>

  <div class="text-teal-500 font-medium text-lg mb-2 mt-6">@ru Прочие языки @en Other languages @endru</div>
  <p>HTML, CSS, SASS.</p>

  <div class="text-teal-500 font-medium text-lg mb-2 mt-6">@ru Технологии и софт @en Technology and Software @endru</div>
  <ul>
    <li class="mb-2">
      <strong>Ansible</strong>
      @ru
      — простым и централизованным образом настраивал серверы.
      @en
      @endru
    </li>
    <li class="mb-2">
      <strong>BitTorrent</strong>
      @ru
        — написал серверную часть (анонсер) для координации взаимодействия клиентов в сети BitTorrent.
      @en
      @endru
    </li>
    {{--
      <li class="mb-2">
        <strong>CFEngine</strong>
        — централизованная настройка серверов до перехода на Ansible.
      </li>
    --}}
    <li class="mb-2">
      <strong>Jenkins</strong>
      @ru
        — деплой сайтов при появлении изменений в репозиториях.
      @en
      @endru
    </li>
    <li class="mb-2">
      <strong>Laravel</strong>
      @ru
        — основной инструмент разработки сайтов с декабря 2014 года. Сподвигнул забросить собственный фреймворк и сделать упор на создание большего количества полезных сервисов. Делал поддержку многоязычности для данного сайта. Пользовался большинством компонентов, представленных в документации фреймворка.
      @en
      @endru
    </li>
    <li class="mb-2">
      <strong>libev</strong>
      @ru
        — без этой библиотеки не обошлось ни одно приложение, написанное на перле с использованием событийной модели.
      @en
      @endru
    </li>
    <li class="mb-2">
      <strong>memcached</strong>
      @ru
        — ускоряет проекты с первой встречи.
      @en
      @endru
    </li>
    <li class="mb-2">
      <strong>MySQL</strong>
      @ru
        — хранилище данных всех сайтов.
      @en
      @endru
    </li>
    <li class="mb-2">
      <strong>nginx</strong>
      @ru
        — многолетний опыт настройки, проксирование файлов из отдаленных регионов (S3).
      @en
      @endru
    </li>
    {{--
      <li class="mb-2">
        <strong>Pano2VR</strong>
        — панорамы, виртуальные туры.
      </li>
    --}}
    <li class="mb-2">
      <strong>sphinxsearch</strong>
      @ru
        — полнотекстовый поиск, поисковые подсказки.
      @en
      @endru
    </li>
    <li>
      <strong>Vue.js</strong>
      @ru
        — богатые возможности для интерфейсов. Использую с осени 2016 года. Знаком и использовал vue-router и vuex.
      @en
      @endru
    </li>
  </ul>

  <div class="text-teal-500 font-medium text-lg mb-2 mt-6">@ru Иностранные языки @en Foreign languages @endru</div>
  <ul>
    @ru
    @en
      <li class="mb-2">
        <strong>Russian</strong>
        — native.
      </li>
    @endru
    <li class="mb-2">
      <strong>@ru Английский @en English @endru</strong>
      @ru — свободный. @en — fluent. @endru
    </li>
    <li class="mb-2">
      <strong>@ru Немецкий @en German @endru</strong>
      @ru — начальный. @en — beginner. @endru
    </li>
    <li>
      <strong>@ru Японский @en Japanese @endru</strong>
      @ru — начальный. @en — beginner. @endru
    </li>
  </ul>

  <div class="text-teal-500 font-medium text-lg mb-2 mt-6">@ru Работа с API @en APIs usage @endru</div>
  @ru
    <p>Вход через соцсети: Facebook, GitHub, Google, Instagram, OK, Twitter, VK, Яндекс.</p>
  @en
    <p>Social login via Facebook, GitHub, Google, Instagram, OK, Twitter, VK, and Yandex.</p>
  @endru
  <ul>
    <li class="mb-2">
      <strong>Google</strong>
      @ru — геокодер и карты. @en — geocoder and maps. @endru
    </li>
    <li class="mb-2">
      <strong>OZON.ru</strong>
      @ru
        — использовался для разработки white-label сайта, позволяющего заказывать товары с озона по программе лояльности.
      @en
      @endru
    </li>
    <li class="mb-2">
      <strong>WebMoney</strong>
      @ru — прием платежей. @en — payments processing. @endru
    </li>
    <li>
      <strong>@ru Яндекс @en Yandex @endru</strong>
      @ru
        — геокодер, касса, карты и почта для домена.
      @en
        — geocoder, payments processing, maps, and mail for a domain.
      @endru
    </li>
  </ul>

  <div class="my-caption font-medium text-2xl mb-2 mt-12 uppercase">@ru Проекты @en Projects @endru</div>
  @ru
    <p>По списку ниже можно заметить, что важные для меня проекты стараюсь не бросать и поддерживать годами.</p>
  @en
    <p>It's easy to notice that I tend to support the projects that are important to me.</p>
  @endru

  <div class="mb-1">@ru Легенда: @en Legend: @endru</div>

  <div class="mb-1">
    <span class="text-orange-300">@svg (star)</span>
    @ru любимый проект @en favorite project @endru
  </div>
  <div class="mb-1">
    <span class="text-green-500">@svg (primitive-dot)</span>
    @ru проект жив и здоров @en project is up and running @endru
  </div>
  <div class="mb-1">
    <span class="text-muted">@svg (primitive-dot)</span>
    @ru проект более недоступен, например, его переделали или выключили, но могли остаться исходники @en project is no longer available—it was rebuilt or shut down—still there might be source code available @endru
  </div>
  <div>
    @svg (github)
    @ru ссылка на исходники @en source code link @endru
  </div>

  <div class="font-medium text-xl mb-2 portfolio-year">@ru В настоящее время @en Present @endru</div>
  <div>
    <div class="font-medium text-lg mb-2">
      <span class="text-orange-300">@svg (star)</span>
      <span class="text-muted">@svg (primitive-dot)</span>
      <a href="https://kupislona.ru/" rel="nofollow">kupislona.ru</a>
    </div>
    <div class="my-2 svg-muted text-muted">
      @svg (calendar)
      @ru с декабря 2014 года @en December 2014 — Present @endru
    </div>
    @ru
      <p>Моя задача состояла в создании с нуля доски объявлений (классифайда) для Калуги и Калужской области. С 2018 года на сайт добавлены регионы со всей России. Я продолжаю развитие и поддержку проекта.</p>
    @en
      <p>I was responsible to make classified advertising site kupislona.ru from scratch and launch it. Now I continue to develop and support it.</p>
    @endru

    @ru
      <p>Проект разработан с использованием PHP, Laravel, MySQL, Memcached, Javascript (ES6), Vue.js, SASS, Webpack, Sphinxsearch. Работает на 2 VDS, развернутых и настроенных с помощью Ansible. Код хранится в Bitbucket. Деплой выполняется с помощью Jenkins при каждом коммите в ветку main.</p>
    @en
      <p>It was built using PHP, Laravel, MySQL, Memcached, Javascript (ES6), Vue.js, SASS, Webpack, Sphinxsearch. 2 VDS were deployed and configured by Ansible. Code is hosted on Bitbucket and deployed by Jenkins on every commit to the main branch.</p>
    @endru

    @ru
      <div>Ключевые особенности проекта:</div>
    @en
      <div>Key features:</div>
    @endru

    <ul>
      @ru
        <li>около тысячи регионов по всей России и около пятиста рубрик для подачи бесплатного объявления;</li>
      @en
        <li>More than 1,000 cities all over Russia and about 500 categories to submit a free ad.</li>
      @endru
      @ru
        <li>каждая рубрика обладает уникальным набором свойств для заполнения и последующей сортировки объявлений;</li>
      @en
        <li>Each category features a unique set of fields to ease the search.</li>
      @endru
      @ru
        <li>геолокация по айпи, чтобы выдать максимально близкие к пользователю объявления;</li>
      @en
        <li>IP geolocation to make sure users see ads of their region on the first visit.</li>
      @endru
      @ru
        <li>геокодер Яндекса для подсказки адреса по мере ввода, а также вывод объектов и мест сделки на карте;</li>
      @en
        <li>Address suggestions via Yandex and Google geocoders to show ads on the map.</li>
      @endru
      @ru
        <li>нормализация и автоматическое форматирование мобильных и городских телефонных номеров, чтобы пользователи видели их в привычном им виде;</li>
      @en
        <li>Phone normalization and formatting to show mobile and local businesses' phone numbers in a way that is familiar to locals.</li>
      @endru
      @ru
        <li>полнотекстовый поиск с помощью Sphinxsearch;</li>
      @en
        <li>Full-text search via Sphinxsearch.</li>
      @endru
      @ru
        <li>поисковые подсказки (автодополнение);</li>
      @en
        <li>Search suggestions (autocompletion).</li>
      @endru
      @ru
        <li>очередь модерации объявлений, выявление дублей, умные условия отправки на повторную модерацию;</li>
      @en
        <li>Moderation queue for ads, searching for duplicates.</li>
      @endru
      @ru
        <li>выявление связанных учетных записей злоумышленников;</li>
      @en
        <li>Detection of related users to prevent them from posting abusive ads.</li>
      @endru
      @ru
        <li>хранение фотографий в S3, плюс бэкапы в Rackspace, прокси в России для быстрого вывода фотографий и их миниатюр;</li>
      @en
        <li>S3 as a photo storage, Rackspace as a backup, proxy in Russia as a fast way to deliver photos and thumbnails.</li>
      @endru
      @ru
        <li>чат в реальном времени между продавцами и покупателями;</li>
      @en
        <li>Real-time chat between sellers and buyers.</li>
      @endru
      @ru
        <li>вход в один клик через социальные сети и по ссылкам в письмах;</li>
      @en
        <li>One-click login using email links and popular social networks.</li>
      @endru
      @ru
        <li>платные услуги для продвижения в списке объявлений;</li>
      @en
        <li>Paid features to advertise ad in the list.</li>
      @endru
      @ru
        <li>платная подписка для риэлторов с автоматическим продлением;</li>
      @en
        <li>Paid subscription for realtors with recurring payments.</li>
      @endru
      @ru
        <li>сбор метрик для оценки использования функционала;</li>
      @en
        <li>Lots of backend metrics to assess the usage of features.</li>
      @endru
      @ru
        <li>черные списки телефонов и IP;</li>
      @en
        <li>Blacklists of IPs and phones.</li>
      @endru
      @ru
        <li>избранные объявления для гостей и пользователей с синхронизацией при аутентификации;</li>
      @en
        <li>Favorite list of ads for guests and users.</li>
      @endru
      @ru
        <li>разграничение доступа по ролям;</li>
      @en
        <li>Role-based permissions for developers, admins, and moderators.</li>
      @endru
      @ru
        <li>SMTP-сервер, а также текстовые версии писем в дополнение к HTML-версиям для повышения надежности доставки писем;</li>
      @en
        <li>Setup of an SMTP server, also HTML and plain-text version of emails to ensure reliable delivery to popular email providers.</li>
      @endru
      @ru
        <li>лимиты на создание диалогов и подачу объявлений для предотвращения спама.</li>
      @en
        <li>Daily limits by IP and user ID for posting new ads and conversations to prevent spam.</li>
      @endru
    </ul>

    <div class="font-medium text-lg mb-2 mt-6">
      <span class="text-orange-300">@svg (star)</span>
      <span class="text-green-500">@svg (primitive-dot)</span>
      <a href="/">vacuum.name</a>
      <a href="https://github.com/ivacuum/hosting" rel="nofollow">@svg (github)</a>
    </div>
    <div class="my-2 svg-muted text-muted">
      @svg (calendar)
      @ru с февраля 2015 года @en Since February 2015 — Present @endru
    </div>
    @ru
      <p>Смена домена существующего более десяти лет сайта <strong>ivacuum.ru</strong> для улучшения позиций в иностранных поисковиках. Воссоздание сайта с использованием Laravel, SASS, Vue.js и прочих современных технологий.</p>
      <p><strong>Открытие <a href="/life">раздела заметок</a></strong>. По состоянию на 2018 год это <strong>150+</strong> историй с около <strong class="whitespace-nowrap">7&thinsp;000</strong> фотографий и более <strong class="whitespace-nowrap">4&thinsp;000</strong> абзацев текста о посещенных городах, странах и концертах. Около <strong class="whitespace-nowrap">1&thinsp;500</strong> абзацев текста переведены на английский язык. Практически все фотографии можно посмотреть на <a href="/photos/map">карте мира</a>, благодаря сохранению и обработке геометок снимков.</p>
      <p><strong>Раздел о <a href="/japanese">японском языке</a></strong>. Он понадобился вслед за созданием тренажера японских азбук и помощника по изучению иероглифов.</p>
    @endru
  </div>

  <div class="font-medium text-xl mb-2 portfolio-year">2014</div>
  <div>
    <div class="font-medium text-lg mb-2">
      <span class="text-green-500">@svg (primitive-dot)</span>
      <a href="http://www.veloman.org/" rel="nofollow">veloman.org</a>
    </div>
    @ru
      <p>В дополнение к физическому магазину Веломан был сделан интернет-магазин с <strong>интеграцией с 1С</strong>. Все представленные на сайте товары можно купить с оплатой через Робокассу.</p>
    @endru
  </div>

  <div class="font-medium text-xl mb-2 portfolio-year">2013</div>
  <div>
    @ru
      <p>Проектирование хостинга для веб-студии Корден. Централизованное управление кластером из 6 серверов. Использование Ansible для развертывания и настройки серверов под управлением FreeBSD.</p>
    @endru

    <div class="font-medium text-lg mb-2 mt-6">
      <span class="svg-muted">@svg (primitive-dot)</span>
      Теплоклуб
    </div>
    @ru
      <p>Разработан сайт, позволяющий клиентам компании <a href="https://www.knaufinsulation.ru/" rel="nofollow">Knauf Insulation</a> за накопленную виртуальную валюту программы лояльности купить реальные товары интернет-магазина <a href="https://www.ozon.ru/" rel="nofollow">OZON.ru</a> на разработанном white-label сайте.</p>
    @endru

    <div class="font-medium text-lg mb-2 mt-6">
      <span class="svg-muted">@svg (primitive-dot)</span>
      FW
      <a href="https://github.com/ivacuum/fw" rel="nofollow">@svg (github)</a>
    </div>
    @ru
      <p>Собственный фреймворк для разработки сайтов.</p>
    @endru
  </div>

  <div class="font-medium text-xl mb-2 portfolio-year">2012</div>
  <div>
    @ru
      <p>Организация рабочего процесса разработки сайтов в веб-студии Корден: тестовые площадки, использование системы контроля версий, работа в команде, использование системы интеграции для распространения кода по серверам.</p>
      {{--<p>Сборка виртуальных туров из панорам: <a href="http://nayadakaluga.ru/pano-moskovski" rel="nofollow">ТЦ Московский</a>, <a href="http://nayadakaluga.ru/pano-suvorovski" rel="nofollow">ТЦ Суворовский</a>, <a href="http://nayadakaluga.ru/pano-obninsk" rel="nofollow">Технокерамика</a>.</p>--}}
    @endru
    <div class="font-medium text-lg mb-2 mt-6">
      <span class="svg-muted">@svg (primitive-dot)</span>
      kwan-park.ru
    </div>
    @ru
      <p>Разработка сайта спортивного и гостиничного комплекса Квань.</p>
    @endru
  </div>

  <div class="font-medium text-xl mb-2 portfolio-year">2011</div>
  <div>
    <div class="font-medium text-lg mb-2">
      <span class="text-green-500">@svg (primitive-dot)</span>
      <a href="https://korden.org" rel="nofollow">korden.org</a>
    </div>
    @ru
      <p>Проектирование и разработка системы документооборота &mdash; выставление счетов, актов, формирование договоров, оплата по безналичному переводу и WebMoney.</p>
    @endru
  </div>

  <div class="font-medium text-xl mb-2 portfolio-year">2010</div>
  <div>
    <div class="font-medium text-lg mb-2">
      <span class="text-green-500">@svg (primitive-dot)</span>
      BTT
      <a href="https://github.com/ivacuum/btt" rel="nofollow">@svg (github)</a>
    </div>
    @ru
      <p>Координатор взаимодействия клиентов в сети BitTorrent. В первые же месяцы обслуживал порядка 3&thinsp;000&thinsp;000 подключений в день — около 100 запросов в секунду в вечернее время. Написан на языке Perl на основе демона статистики для игры Counter-Strike, выпущенного годом ранее. В 2012 году представлен как <strong>дипломный проект</strong> при выпуске из МГТУ им. Баумана.</p>
    @endru

    <div class="font-medium text-lg mb-2 mt-6">
      <span class="text-green-500">@svg (primitive-dot)</span>
      <a href="/retracker">BTRT</a>
      <a href="https://github.com/ivacuum/btrt" rel="nofollow">@svg (github)</a>
    </div>
    @ru
      <p>Оптимизация файлообмена в сети BitTorrent. Совместное скачивание файлов пользователями сети одного провайдера. Позволяет, например, вдесятером превратить 0,25 Мбит/сек в 2,50 Мбит/сек при скачивании всеми одной раздачи. Если у кого-то уже есть необходимый файл, то скачивание производится на максильной доступной скорости локальной сети, например, 100 Мбит/сек.</p>
    @endru

    <div class="font-medium text-lg mb-2 mt-6">
      <span class="text-green-500">@svg (primitive-dot)</span>
      <a href="http://t.ivacuum.ru/">torrent.ivacuum.ru</a>
      <a href="https://github.com/ivacuum/t.ivacuum.ru" rel="nofollow">@svg (github)</a>
    </div>
    @ru
      <p>Сайт, он же торрент-трекер в локальной сети Билайн-Калуга на основе форума phpBB. В красивом виде представляет данные от демона btt.ivacuum.ru. С 1 января 2017 года переведен в архивный режим.</p>
    @endru
  </div>

  <div class="font-medium text-xl mb-2 portfolio-year">2009</div>
  <div>
    <div class="font-medium text-lg mb-2">
      <span class="svg-muted">@svg (primitive-dot)</span>
      CSSTATS
    </div>
    @ru
      <p>Статистика в реальном времени для игры <strong>Counter-Strike</strong>. Для обработки и реакции на сообщения игровых серверов написан демон на языке <strong>Perl</strong>. В основе демона событийная модель и парсер текста. Администраторский доступ к игровым серверам позволяет демону реагировать на игровые события, например, предовращать стрельбу по игрокам своей команды или включать звук «уиии, свежее мясо» всем игрокам при совершении кем-то фрага с ножа. Учет особенностей локальной сети Спарк-Калуга позволяет банить игроков по их подсети.</p>
      <p>Накопленная демоном статистика выводится в отдельном разделе сайта. На главной странице можно посмотреть текущую сводку, совпадающую с таковой при нажатии кнопки Tab в игре. Также доступны графики посещаемости серверов. В своем профиле игрок может увидеть ранг относительно других игроков, а также подробную статистику по использованному оружию и прочие параметры. Для просмотра глобальной статистики популярных видов оружия и карт предусмотрены отдельные страницы. Для стимулирования игрового процесса придуманы лычки (достижения).</p>
      <p>Проект представлен в качестве <strong>курсовой работы</strong> по сетевым приложениям в МГТУ им. Баумана.</p>
    @endru

    <div class="font-medium text-lg mb-2 mt-6">
      <span class="svg-muted">@svg (primitive-dot)</span>
      bugs.ivacuum.ru
    </div>
    @ru
      <p>Баг-трекер — сервис для учета и хранения задач, которые необходимо выполнить.</p>
    @endru

    <div class="font-medium text-lg mb-2 mt-6">
      <span class="text-green-500">@svg (primitive-dot)</span>
      <a href="https://img.ivacuum.ru/stats">img.ivacuum.ru</a>
      <a href="https://github.com/ivacuum/imageviewer" rel="nofollow">@svg (github)</a>
    </div>
    @ru
      <p>Сервис подсчета просмотров изображений. Более 100&thinsp;000&thinsp;000 просмотров за время существования.</p>
    @endru

    <div class="font-medium text-lg mb-2 mt-6">
      <span class="text-green-500">@svg (primitive-dot)</span>
      <a href="/gallery">up.ivacuum.ru</a>
    </div>
    @ru
      <p>Сервис загрузки изображений. За время существования пользователями загружено более 200&thinsp;000 изображений.</p>
    @endru
  </div>

  <div class="font-medium text-xl mb-2 portfolio-year">2008</div>
  <div>
    <div class="font-medium text-lg mb-2">
      <span class="svg-muted">@svg (primitive-dot)</span>
      ivacuum.ru/игры/
    </div>
    @ru
      <p>Мониторинг игровых серверов Call of Duty, Counter-Strike, Diablo II, Killing Floor, Left 4 Dead, Warcraft 3. Инструкции для игры по сети. Обслуживание игровых серверов.</p>
    @endru

    <div class="font-medium text-lg mb-2 mt-6">
      <span class="svg-muted">@svg (primitive-dot)</span>
      torrent.elcomnet.ru
    </div>
    @ru
      <p>Обслуживание и улучшение торрент-трекера в локальной сети Спарк-Калуга.</p>
    @endru
  </div>

  <div class="font-medium text-xl mb-2 portfolio-year">2007</div>
  <div>
    @ru
      <p>Сборка, запуск и администрирование игровых серверов в локальной сети Спарк-Калуга. Основной упор на игру Counter-Strike. Организация и проведение нескольких турниров.</p>
    @endru

    <div class="font-medium text-lg mb-2 mt-6">
      <span class="text-green-500">@svg (primitive-dot)</span>
      <a href="/dc">dc.ivacuum.ru</a>
    </div>
    @ru
      <p>Энциклопедия клиентов DC++. Ответы на часто задаваемые вопросы.</p>
    @endru

    <div class="font-medium text-lg mb-2 mt-6">
      <span class="text-green-500">@svg (primitive-dot)</span>
      <a href="/files">dl.ivacuum.ru</a>
    </div>
    @ru
      <p>Сервис учета скачиваний файлов. Более 1&thinsp;900&thinsp;000 скачиваний за время существования ресурса.</p>
    @endru
  </div>

  <div class="font-medium text-xl mb-2 portfolio-year">2006</div>
  <div>
    <div class="font-medium text-lg mb-2">
      <span class="svg-muted">@svg (primitive-dot)</span>
      school5.kaluga.ru
    </div>
    @ru
      <p>Сайт школы №5 города Калуги. Проект был представлен на выпускном школьном экзамене.</p>
    @endru
  </div>

  <div class="font-medium text-xl mb-2 portfolio-year">2004</div>
  <div>
    <div class="font-medium text-lg mb-2">
      <span class="svg-muted">@svg (primitive-dot)</span>
      combats.ivacuum.ru
      <a href="https://github.com/ivacuum/combats.ivacuum.ru" rel="nofollow">@svg (github)</a>
    </div>
    @ru
      <p>Клон браузерной игры Бойцовский Клуб. Персонажи, предметы, магазины, одиночные и групповые бои, перемещение как по локациям в городе, так и между городами.</p>
    @endru
  </div>

  <div class="font-medium text-xl mb-2 portfolio-year">2003</div>
  <div>
    <div class="font-medium text-lg mb-2">
      <span class="text-green-500">@svg (primitive-dot)</span>
      <a href="/">ivacuum.ru</a>
      <a href="https://github.com/ivacuum/hosting" rel="nofollow">@svg (github)</a>
    </div>
    @ru
      <div>Запуск головного сайта собственных проектов. В основе новостная лента и гостевая книга — стандартный набор для сайтов тех времен.</div>
    @endru
  </div>
</div>
</body>
</html>
