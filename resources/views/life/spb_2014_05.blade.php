@extends('life.base', [
  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Санкт-Петербург', 'url' => 'life/spb'],
    ['title' => '8–12 мая 2014']
  ]
])

@section('content')
<h2>
  <span class="emoji">&#x1f1f7;&#x1f1fa;</span>
  Санкт-Петербург
  <small>8–12 мая 2014</small>
</h2>
<p>Реально ли отправиться в другой город с велосипедом? Разумеется! Берется билет на плацкарт, пустой чехол или сумка помещается в рюкзак с прочими вещами, на вокзале с велосипеда снимается одно или два колеса в зависимости от его размера и набитая сумка закидывается на третью полку купе. Доступных 36 кг бесплатного багажа хватит с лихвой.</p>
<div class="fotorama" data-height="750" data-width="563">
  <img src="//life.ivacuum.ru/spb.2014.05/IMG_0522.jpg">
  <img src="//life.ivacuum.ru/spb.2014.05/IMG_0523.jpg">
  <img src="//life.ivacuum.ru/spb.2014.05/IMG_0524.jpg">
</div>

<a name="exhibition_photo"></a>
<div class="img-container">
  <img src="//life.ivacuum.ru/spb.2014.05/IMG_0551.jpg" width="563" height="750">
</div>
@stop
