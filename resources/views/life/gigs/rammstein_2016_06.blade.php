@extends('life.gigs.base')

@section('content')
@ru
  <p>Возвращение фестиваля Максидром после долгого перерыва.</p>
  <p>Камера хранения (еще и бесплатная) — незаменимая вещь, когда у тебя билет в фан-зону, а с собой рюкзак и средних размеров сумка.</p>
  <p>Фестиваль куда проще переносится, если посещать только интересующие группы. В моем случае одну. В итоге гигантская разница с <a class="link" href="rammstein.2013">Роком над Волгой</a> — 3 часа на стадионе против 14 часов на жаре в открытом поле. Последний вариант иначе как выживанием не назовешь.</p>
  <p>Операторы отлично скрасили ожидание подготовки сцены под хэдлайнера камерой поцелуев и выискиванием отдельных забавных посетителей.</p>
@en
  <p>Maxidrom festival returns after a long break.</p>
@endru

@component('tpl.setlist', ['cover' => 'https://life.ivacuum.org/gigs/rammstein.2016.06.19.jpg'])
  <ol>
    <li>Ramm 4</li>
    <li>Reise, Reise</li>
    <li>Hallelujah</li>
    <li>Zerstören</li>
    <li>Keine Lust</li>
    <li>
      <a class="link" href="https://www.youtube.com/watch?v=QtUuBaX3LRY&t=260">Feuer frei!</a>
      @svg (heart)
    </li>
    <li>Seemann</li>
    <li>Ich tu dir weh</li>
    <li>Du riechst so gut</li>
    <li>Mein Herz brennt</li>
    <li>Links 2-3-4</li>
    <li>Ich will</li>
    <li>
      <a class="link" href="https://www.youtube.com/watch?v=lV6x2Ctk6CI">Du hast</a>
      @svg (heart)
    </li>
    <li>Stripped</li>
    <li>Sonne</li>
    <li>Amerika</li>
    <li>Engel</li>
    <li>Moskau</li>
  </ol>
@endcomponent

@ru
  <p>Звуки взрывов были крайне мощными и громкими. Уже и позабылось как было на прошлых концертах.</p>
  <p>Новый свет фантастический. Нужен ракурс видео по центру, чтобы всю задуманную красоту оценить.</p>
@endru
<youtube title="Rammstein 2016, Maxidrom, Moscow, Russia" v="ateEiEHKBWE"></youtube>
@endsection
