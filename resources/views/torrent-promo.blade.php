@extends('base', [
  'bodyClasses' => '',
  'navbarClasses' => '',
  'noLanguageSelector' => $locale === 'ru',
  'contentContainerClasses' => 'antialiased hanging-puntuation-first lg:text-lg',
])

@section('bottom-tabbar')
@endsection

@section('content')
<section class="bg-light pt-4 pb-12">
  <div class="container lg:max-w-3xl">
    <div class="text-center mb-4">
      <a href="@lng/torrents">
        <img class="w-16 h-16" src="https://ivacuum.org/i/t/images/logo_arrows.png" alt="">
      </a>
    </div>
    <h1 class="h2">Торрент-трекер в локальной сети Билайн-Калуга</h1>
    <p><strong>torrent.ivacuum.ru</strong> &mdash; наглядный сервис для обмена файлами, открывшийся <span class="whitespace-nowrap">5 июля</span> 2010 года в локальной сети Билайн города Калуга. Трекер довольно быстро набрал основную массу пользователей и стал местом общения нескольких тысяч калужан. <span class="whitespace-nowrap">1 января 2017</span> года он потерял пристанище в локальной сети и переместился в интернет. Вместе с тем была закрыта регистрация новых пользователей в пользу перехода на новый торрент-трекер на основе магнет-ссылок, открывшийся <span class="whitespace-nowrap">5 января</span> 2017 года.</p>

    <div>
      <a class="btn btn-primary text-lg px-4 py-2" href="@lng/torrents">
        Перейти на трекер
        @svg (angle-right)
      </a>
    </div>
  </div>
</section>

<section class="border-t border-b border-grey-200 py-12">
  <div class="container lg:max-w-3xl">
    <h2 class="h3">Я подключен к ТТК (Спарку), Ростелекому, МТС, Макснету, ДомНету. Можно ли воспользоваться вашим трекером? Нужна ли локальная сеть для доступа к ресурсам?</h2>
    <p>Трекер доступен через интернет для всех желающих. Локальная сеть более не обязательна для подключения. Калуга тоже больше не ограничение — можно заходить из любой точки мира.</p>

    <div>
      <a class="btn btn-primary text-lg px-4 py-2" href="@lng/torrents">
        Перейти на трекер
        @svg (angle-right)
      </a>
    </div>
  </div>
</section>

<section class="bg-light py-12">
  <div class="container lg:max-w-3xl">
    <h3>Доступен ли еще тот старый трекер 2010 года?</h3>
    <p>Да, он все еще доступен. Нынче он больше похож на форум, так как вместе с открытием нового трекера в начале 2017 года на <strong>t.ivacuum.ru</strong> была закрыта регистрация новых пользователей. Если у вас нет учетки или она была удалена за неактивностью, то вам будет доступно для чтения всего несколько разделов.</p>

    <div>
      <a class="btn btn-default text-lg px-4 py-2" href="http://t.ivacuum.ru/">
        Перейти на <span class="hidden md:inline">старый трекер</span> t.ivacuum.ru
        @svg (angle-right)
      </a>
    </div>
  </div>
</section>

<section class="bg-gray-700 py-20 text-gray-300">
  <div class="container lg:max-w-3xl">
    <h3 class="text-gray-200 mb-6">Ключевые особенности трекера t.ivacuum.ru</h3>
    <div class="grid md:grid-cols-2 gap-x-12 gap-y-8">
      <div>
        <h5 class="text-gray-400">Обсуждение раздач</h5>
        <div>Трекер построен на основе форума, следовательно, можно не только скачивать раздачи, но и комментировать их и читать отзывы других посетителей.</div>
      </div>
      <div>
        <h5 class="text-gray-400">Отсутствие рейтинга</h5>
        <div>Рейтинг &mdash; не повод отказывать себе в просмотре интересного материала! Скачивайте любое количество информации!</div>
      </div>
      <div>
        <h5 class="text-gray-400">Скорость обмена</h5>
        <div>Абоненты Билайн-Калуга &mdash; счастливые обладатели возможности обмениваться информацией на скорости до 100 мбит в секунду!</div>
      </div>
      <div>
        <h5 class="text-gray-400">Быстродействие</h5>
        <div>Узкие места трекера были оптимизированы для достижения максимального быстродействия и низкого времени отклика.</div>
      </div>
      <div>
        <h5 class="text-gray-400">Опытная команда</h5>
        <div>Администраторы знакомы с технологией BitTorrent и возможностями трекера уже много лет и всегда готовы прийти вам на помощь.</div>
      </div>
      <div>
        <h5 class="text-gray-400">Поиск</h5>
        <div>Умная система поиска найдет раздачи даже по одному символу! А также предложит подсказки по мере ввода запроса!</div>
      </div>
      <div>
        <h5 class="text-gray-400">Информеры</h5>
        <div>Всегда будьте в курсе прогноза погоды, курса валют и новых раздач. Всё самое необходимое &mdash; на главной странице трекера.</div>
      </div>
      {{--
      <div>
        <h5 class="text-gray-400">Ленты</h5>
        <div>Читайте новости, гороскоп и истории с развлекательных сайтов не выходя с трекера!</div>
      </div>
      --}}
      <div>
        <h5 class="text-gray-400">Графики</h5>
        <div>Вы можете окунуться в историю развития трекера, посмотрев на рост графиков статистики: скорости обмена, посещамости, притока пользователей, раздач, сообщений и трафика.</div>
      </div>
    </div>
  </div>
</section>

<section class="py-12">
  <div class="container lg:max-w-3xl">
    <h3>Какие еще есть полезные ресурсы помимо трекера?</h3>
    <p>Ознакомиться с актуальным списком можно на отдельной странице.</p>
    <div class="mt-4">
      <a class="btn btn-default" href="{{ to('/') }}">
        Список ресурсов
        @svg (angle-right)
      </a>
    </div>
  </div>
</section>
    @ru
    @en
      <h1 class="h2">Torrent-tracker in Beeline network in Kaluga</h1>
      <p><a class="btn btn-primary text-lg px-4 py-2" href="http://t.ivacuum.ru/">Go to the tracker &rarr;</a></p>
    @endru
@endsection

@section('footer_container')
@endsection
