@extends('torrents.base')

@section('content')
<div class="faq-question">
  <a class="faq-anchor" name="what-is-it" href="#what-is-it">
    @svg (link)
  </a>
  Что это за ресурс?
</div>
<p>Каталог магнет-ссылок для скачивания информации из интернета.</p>

<div class="faq-question">
  <a class="faq-anchor" name="who-is-it-for" href="#who-is-it-for">
    @svg (link)
  </a>
  Для кого он?
</div>
<p>Хороший вопрос.</p>

<div class="faq-question">
  <a class="faq-anchor" name="how-is-it-different" href="#how-is-it-different">
    @svg (link)
  </a>
  Чем отличается от других торрент-трекеров?
</div>

<div class="faq-question">
  <a class="faq-anchor" name="how-can-i-release" href="#how-can-i-release">
    @svg (link)
  </a>
  Как добавить раздачу?
</div>
<p>Для добавления предусмотрена <a class="link" href="{{ action('Torrents@add') }}">отдельная страница</a>. В качестве ввода принимается три типа значений:</p>
<ol>
  <li>Ссылка на раздачу на рутрекере вида <code>http://rutracker.org/forum/viewtopic.php?t=4031882</code>. Адрес maintracker.org также поддерживается</li>
  <li>Инфо-хэш раздачи вида <code>9B5D85FFC234737E7D7C246FECB6BB1EC5E8F0B9</code></li>
  <li>Номер темы на рутрекере вида <code>4031882</code></li>
</ol>

<div class="faq-question">
  <a class="faq-anchor" name="how-can-i-edit-release" href="#how-can-i-edit-release">
    @svg (link)
  </a>
  Как обновить раздачу?
</div>
<p>Ручное редактирование на данный момент не предусмотрено. Обновление раздачи происходит автоматически по ссылке, которая использовалась при ее добавлении.</p>
@endsection
