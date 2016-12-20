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
<p>По клику на иконку @svg (magnet) в списке раздач, либо на кнопку «Скачать» на странице раздачи. Ваш торрент-клиент должен поддерживать магнет-ссылки.</p>
<p>Рекомендуемые клиенты:</p>
<ul>
  <li>qBittorrent</li>
  <li>Deluge</li>
  <li>Transmission</li>
  <li>uTorrent</li>
</ul>

<div class="faq-question">
  <a class="faq-anchor" name="how-can-i-release" href="#how-can-i-release">
    @svg (link)
  </a>
  Как добавить раздачу?
</div>
<p>Для добавления предусмотрена <a class="link" href="{{ action('Torrents@add') }}">отдельная страница</a>. В качестве ввода принимается три типа значений:</p>
<ol>
  <li>Ссылка на раздачу на рутрекере вида <code>http://rutracker.org/forum/<wbr>viewtopic.php?t=4031882</code>. Адрес maintracker.org также поддерживается</li>
  <li>Инфо-хэш раздачи вида <code>9B5D85FFC234737E7D7C<wbr>246FECB6BB1EC5E8F0B9</code></li>
  <li>Номер темы на рутрекере вида <code>4031882</code></li>
</ol>

<div class="faq-question">
  <a class="faq-anchor" name="how-can-i-edit-release" href="#how-can-i-edit-release">
    @svg (link)
  </a>
  Как обновить раздачу?
</div>
<p>Ручное редактирование на данный момент не предусмотрено. Обновление раздачи происходит автоматически по ссылке, которая использовалась при ее добавлении.</p>

<div class="faq-question">
  <a class="faq-anchor" name="who-is-seeder" href="#who-is-seeder">
    @svg (link)
  </a>
  Кто такой сид?
</div>
<p>Источник, с которого можно скачать раздачу целиком. Чем больше сидов, тем быстрее происходит обмен данными и, соответственно, скачивание раздачи.</p>
@endsection

@section('content_footer')
  </div>
</div>
@endsection
