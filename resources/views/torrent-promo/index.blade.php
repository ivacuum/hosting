@extends('base', [
  'body_classes' => '',
  'navbar_classes' => '',
  'no_language_selector' => $locale === 'ru',
  'content_container_classes' => 'life-text',
])

@section('bottom-tabbar')
@endsection

@section('content')
<section class="bg-light pt-3 pb-5">
  <div class="tw-container tw-max-w-3xl">
    <div class="text-center tw-mb-4">
      <a href="{{ path('Torrents@index') }}">
        <img src="https://ivacuum.org/i/t/images/logo_arrows.png" width="64" height="64">
      </a>
    </div>
    <h1 class="h2">Торрент-трекер в локальной сети Билайн-Калуга</h1>
    <p><strong>torrent.ivacuum.ru</strong> &mdash; наглядный сервис для обмена файлами, открывшийся <span class="tw-whitespace-no-wrap">5 июля</span> 2010 года в локальной сети Билайн города Калуга. Трекер довольно быстро набрал основную массу пользователей и стал местом общения нескольких тысяч калужан. <span class="tw-whitespace-no-wrap">1 января 2017</span> года он потерял пристанище в локальной сети и переместился в интернет. Вместе с тем была закрыта регистрация новых пользователей в пользу перехода на новый торрент-трекер на основе магнет-ссылок, открывшийся <span class="tw-whitespace-no-wrap">5 января</span> 2017 года.</p>

    <div>
      <a class="btn btn-primary btn-lg" href="{{ path('Torrents@index') }}">
        <span class="tw-mr-1">
          @svg (sign-in)
        </span>
        Перейти на трекер
      </a>
    </div>
  </div>
</section>

<section class="border-top border-bottom py-5">
  <div class="tw-container tw-max-w-3xl">
    <h2 class="h3">Я подключен к ТТК (Спарку), Ростелекому, МТС, Макснету, ДомНету. Можно ли воспользоваться вашим трекером? Нужна ли локальная сеть для доступа к ресурсам?</h2>
    <p>Трекер доступен через интернет для всех желающих. Локальная сеть более не обязательна для подключения. Калуга тоже больше не ограничение — можно заходить из любой точки мира.</p>

    <div>
      <a class="btn btn-primary btn-lg" href="{{ path('Torrents@index') }}">
        <span class="tw-mr-1">
          @svg (sign-in)
        </span>
        Перейти на трекер
      </a>
    </div>
  </div>
</section>

<section class="bg-light py-5">
  <div class="tw-container tw-max-w-3xl">
    <h3>Доступен ли еще тот старый трекер 2010 года?</h3>
    <p>Да, он все еще доступен. Нынче он больше похож на форум, так как вместе с открытием нового трекера в начале 2017 года на <strong>t.ivacuum.ru</strong> была закрыта регистрация новых пользователей. Если у вас нет учетки или она была удалена за неактивностью, то вам будет доступно для чтения всего несколько разделов.</p>

    <div>
      <a class="btn btn-default btn-lg" href="http://t.ivacuum.ru/">
        <span class="tw-mr-1">
          @svg (sign-in)
        </span>
        Перейти на <span class="d-none d-md-inline">старый трекер</span> t.ivacuum.ru
      </a>
    </div>
  </div>
</section>

<section class="bg-dark py-5 text-light">
  <div class="tw-container tw-max-w-3xl">
    <h3 class="tw-mb-6">Ключевые особенности трекера t.ivacuum.ru</h3>
    <div class="row">
      <div class="col-md-6">
        <h5 class="text-secondary">Обсуждение раздач</h5>
        <p>Трекер построен на основе форума, следовательно, можно не только скачивать раздачи, но и комментировать их и читать отзывы других посетителей.</p>
      </div>
      <div class="col-md-6">
        <h5 class="text-secondary">Отсутствие рейтинга</h5>
        <p>Рейтинг &mdash; не повод отказывать себе в просмотре интересного материала! Скачивайте любое количество информации!</p>
      </div>
      <div class="col-md-6">
        <h5 class="text-secondary">Скорость обмена</h5>
        <p>Абоненты Билайн-Калуга &mdash; счастливые обладатели возможности обмениваться информацией на скорости до 100 мбит в секунду!</p>
      </div>
      <div class="col-md-6">
        <h5 class="text-secondary">Быстродействие</h5>
        <p>Узкие места трекера были оптимизированы для достижения максимального быстродействия и низкого времени отклика.</p>
      </div>
      <div class="col-md-6">
        <h5 class="text-secondary">Опытная команда</h5>
        <p>Администраторы знакомы с технологией BitTorrent и возможностями трекера уже много лет и всегда готовы прийти вам на помощь.</p>
      </div>
      <div class="col-md-6">
        <h5 class="text-secondary">Поиск</h5>
        <p>Умная система поиска найдет раздачи даже по одному символу! А также предложит подсказки по мере ввода запроса!</p>
      </div>
      <div class="col-md-6">
        <h5 class="text-secondary">Информеры</h5>
        <p>Всегда будьте в курсе прогноза погоды, курса валют и новых раздач. Всё самое необходимое &mdash; на главной странице трекера.</p>
      </div>
      {{--
      <div class="col-md-6">
        <h5>Ленты</h5>
        <p>Читайте новости, гороскоп и истории с развлекательных сайтов не выходя с трекера!</p>
      </div>
      --}}
      <div class="col-md-6">
        <h5 class="text-secondary">Графики</h5>
        <p>Вы можете окунуться в историю развития трекера, посмотрев на рост графиков статистики: скорости обмена, посещамости, притока пользователей, раздач, сообщений и трафика.</p>
      </div>
    </div>
  </div>
</section>

<section class="py-5">
  <div class="tw-container tw-max-w-3xl">
    <h3>Какие еще есть полезные ресурсы помимо трекера?</h3>
    <p>Ознакомиться с актуальным списком можно на отдельной странице.</p>
    <div class="tw-mt-4">
      <a class="btn btn-secondary" href="{{ path('Home@index') }}">
        <span class="tw-mr-1">
          @svg (sign-in)
        </span>
        Список ресурсов
      </a>
    </div>
  </div>
</section>
    @ru
    @en
      <h1 class="h2">Torrent-tracker in Beeline network in Kaluga</h1>
      <p><a class="btn btn-primary btn-lg" href="http://t.ivacuum.ru/">Go to the tracker &rarr;</a></p>
    @endru
@endsection

@section('footer_container')
@endsection
