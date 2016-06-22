@extends('life.base', [
  'meta_title' => 'Oomph! в Москве &middot; 4 ноября 2015',
  'meta_description' => 'Заметки о концерте.',
  'meta_image' => 'https://life.ivacuum.ru/gigs/oomph.2015.11.04.jpg',

  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Концерты', 'url' => 'life/gigs'],
    ['title' => 'Oomph!']
  ]
])

@section('content')
<h2>Oomph! в Москве <small>4 ноября 2015</small></h2>
<div class="row">
  <div class="col-md-7">
    <p>Если в <a class="link" href="/life/oomph.2012">2012 году</a> немцы начали тур с Москвы, то в этот раз они в столице его закончили, то есть могли свободно задержаться на афтепати. Впрочем, мы получили бонус и во время шоу — плюс две песни относительно других концертов тура, причем исполненные одним вокалистом. В самом конце забавно было наблюдать по мониторным наушникам его намерения — если он их надевал, то собирался начать следующую песню.</p>
    <p>Что играли:</p>
    <ol>
      <li>Alles aus Liebe</li>
      <li>Labyrinth</li>
      <li>Träumst Du</li>
      <li>Mein Schatz</li>
      <li>Das weisse Licht</li>
      <li>Mein Herz</li>
      <li>Der neue Gott</li>
      <li>Unzerstörbar</li>
      <li>Als wärs das letzte Mal</li>
      <li>Wunschkind</li>
      <li>Jede Reise hat ein Ende</li>
      <li>Bis Der Spiegel Zerbricht</li>
      <li>Jetzt oder nie</li>
      <li>Niemand</li>
      <li>Mitten ins Herz</li>
      <li>Unter diesem Mond</li>
      <li>Auf Kurs</li>
      <li>Sandmann</li>
      <li>Gekreuzigt</li>
      <li>Augen auf!</li>
      <li>Kleinstadtboy</li>
      <li>Gott ist ein Popstar</li>
      <li>Dankeschön</li>
      <li>The Power of Love / Das Letzte Streichholz / Fieber</li>
    </ol>
  </div>
  <div class="col-md-5">
    <div class="img-container">
      <img src="//life.ivacuum.ru/gigs/oomph.2015.11.04.jpg">
    </div>
  </div>
</div>

<p>Видеозапись выступления:</p>
<div class="fotorama" data-width="1280" data-ratio="16/10">
  <a href="http://www.youtube.com/watch?v=FfETlcHkmCU"></a>
</div>

@include('life.timeline.oomph')
@endsection
