@extends('torrents.base')

@section('content_header')
@parent
<div class="row">
  <div class="col-md-6">
@endsection

@section('content')
<div class="faq-question">
  <a class="faq-anchor" name="what-is-it" href="#what-is-it">
    @svg (link)
  </a>
  Что это за ресурс?
</div>
<p>Сайт, на котором можно скачать раздачи rutracker.org с помощью магнет-ссылок. Преимущество ссылок в отсутствии необходимости регистрироваться для скачивания.</p>

<div class="faq-question">
  <a class="faq-anchor" name="who-is-it-for" href="#who-is-it-for">
    @svg (link)
  </a>
  Для кого он?
</div>
<p>Главным образом для тех, кто хочет делиться находками на рутрекере, а также следить за обновлениями раздач на нем.</p>

<div class="faq-question">
  <a class="faq-anchor" name="how-is-it-different" href="#how-is-it-different">
    @svg (link)
  </a>
  Чем отличается от других торрент-трекеров?
</div>
<p>Тем, что для добавления раздачи достаточно вставить ссылку на нее. Где еще можно добавить 5-10 раздач за минуту?</p>

<div class="faq-question">
  <a class="faq-anchor" name="how-do-i-download" href="#how-do-i-download">
    @svg (link)
  </a>
  Как скачать раздачу?
</div>
<p>По клику на иконку @svg (magnet) в списке раздач, либо на кнопку «Скачать» на странице раздачи. Качать можно без регистрации. Ваш торрент-клиент должен поддерживать магнет-ссылки.</p>
<p>Рекомендуемые клиенты:</p>
<ul>
  <li>qBittorrent</li>
  <li>Deluge</li>
  <li>
    <a class="link" href="{{ action('Files@download', 151) }}">Transmission</a>
    <span title="macOS">
      @svg (apple)
    </span>
  </li>
  <li>
    <a class="link" href="{{ action('Files@download', 150) }}">uTorrent</a>
    <span title="Windows">
      @svg (windows)
    </span>
  </li>
</ul>

<div class="faq-question">
  <a class="faq-anchor" name="how-can-i-release" href="#how-can-i-release">
    @svg (link)
  </a>
  Как добавить раздачу?
</div>
<p>Для добавления предусмотрена <a class="link" href="{{ action('Torrents@add') }}">отдельная страница</a>, доступная только зарегистрированным пользователям. В качестве ввода принимается три типа значений:</p>
<ol>
  <li>Ссылка на раздачу на рутрекере вида <code>http://rutracker.org/forum/<wbr>viewtopic.php?t=4031882</code>. Адрес maintracker.org также поддерживается</li>
  <li>Инфо-хэш раздачи вида <code>9B5D85FFC234737E7D7C<wbr>246FECB6BB1EC5E8F0B9</code></li>
  <li>Номер темы на рутрекере вида <code>4031882</code></li>
</ol>

<div class="faq-question">
  <a class="faq-anchor" name="what-account" href="#what-account">
    @svg (link)
  </a>
  Какую учетную запись использовать для входа?
</div>
<p>Ту, что заводили на сайте ivacuum.ru. Если вы хоть раз загружали картинки в галерею, то у вас есть эта учетка. От t.ivacuum.ru учетные записи, к сожалению, не подходят. Если вам нужна помощь, чтобы найти свою учетку, созданные многие годы назад (во времена провайдера Спарк, например), то напишите мне в личку в <a class="link" href="https://vk.com/ivacuum">ВК</a> — постараемся ее найти.</p>

<div class="faq-question">
  <a class="faq-anchor" name="how-can-i-make-unique-release" href="#how-can-i-make-unique-release">
    @svg (link)
  </a>
  Как добавить раздачу, которой нет на рутрекере?
</div>
<p>Сперва добавить ее на рутрекер, а потом указать ссылку на нее.</p>

<div class="faq-question">
  <a class="faq-anchor" name="how-can-i-edit-release" href="#how-can-i-edit-release">
    @svg (link)
  </a>
  Как обновить раздачу?
</div>
<p>Ручное редактирование на данный момент не предусмотрено. Обновление раздач происходит каждую ночь автоматически по ссылке, которая использовалась при ее добавлении.</p>

<div class="faq-question">
  <a class="faq-anchor" name="who-is-seeder" href="#who-is-seeder">
    @svg (link)
  </a>
  Кто такой сид?
</div>
<p>Источник, с которого можно скачать раздачу целиком. Чем больше сидов, тем быстрее происходит обмен данными и, соответственно, скачивание раздачи.</p>

<div class="faq-question">
  <a class="faq-anchor" name="why-release-disappeared" href="#why-release-disappeared">
    @svg (link)
  </a>
  Почему моя раздача пропала?
</div>
<p>Раздачи автоматически удаляются, если они были удалены или закрыты на сайте-первоисточнике rutracker.org.</p>

<div class="faq-question">
  <a class="faq-anchor" name="how-do-i-comment" href="#how-do-i-comment">
    @svg (link)
  </a>
  Как комментировать раздачи?
</div>
<p>Возможность обсуждения и комментирования раздач ожидается во второй половине января.</p>
@endsection

@section('content_footer')
  </div>
</div>
@endsection
