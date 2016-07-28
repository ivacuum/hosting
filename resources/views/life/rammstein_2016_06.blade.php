@extends('life.base', [
  'meta_title' => 'Rammstein в Москве &middot; 19 июня 2016',
  'meta_description' => 'Заметки о концерте.',
  'meta_image' => 'https://life.ivacuum.ru/gigs/rammstein.2016.06.19.jpg',

  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Концерты', 'url' => 'life/gigs'],
    ['title' => 'Rammstein']
  ]
])

@section('content')
<h2>Rammstein в Москве <small>19 июня 2016</small></h2>
<div class="row">
  <div class="col-md-7">
    <p>Возвращение фестиваля Максидром после долгого перерыва.</p>
    <p>Камера хранения (еще и бесплатная) — незаменимая вещь, когда у тебя билет в фан-зону, а с собой рюкзак и средних размеров сумка.</p>
    <p>Фестиваль куда проще переносится, если посещать только интересующие группы. В моем случае одну. В итоге гигантская разница с <a class="link" href="/life/rammstein.2013">Роком над Волгой</a> — 3 часа на стадионе против 14 часов на жаре в открытом поле. Последний вариант иначе как выживанием не назовешь.</p>
    <p>Операторы отлично скрасили ожидание подготовки сцены под хэдлайнера камерой поцелуев и выискиванием отдельных забавных посетителей.</p>
    <p>Что играли:</p>
    <ol>
      <li>Ramm 4</li>
      <li>Reise, Reise</li>
      <li>Hallelujah</li>
      <li>Zerstören</li>
      <li>Keine Lust</li>
      <li>
        <a class="link" href="https://www.youtube.com/watch?v=QtUuBaX3LRY&t=260">Feuer frei!</a>
        @include('tpl.svg.heart')
      </li>
      <li>Seemann</li>
      <li>Ich tu dir weh</li>
      <li>Du riechst so gut</li>
      <li>Mein Herz brennt</li>
      <li>Links 2-3-4</li>
      <li>Ich will</li>
      <li>Du hast</li>
      <li>Stripped</li>
      <li>Sonne</li>
      <li>Amerika</li>
      <li>Engel</li>
      <li>Moskau</li>
    </ol>
  </div>
  <div class="col-md-5">
    <div class="img-container">
      <img src="https://life.ivacuum.ru/gigs/rammstein.2016.06.19.jpg">
    </div>
  </div>
</div>

<p>Звуки взрывов были крайне мощными и громкими. Уже и позабылось как было на прошлых концертах.</p>
<p>Новый свет фантастический. Нужен ракурс видео по центру, чтобы всю задуманную красоту оценить.</p>

@include('life.timeline.rammstein')
@endsection
