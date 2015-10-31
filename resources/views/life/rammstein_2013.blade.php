@extends('life.base', [
  'meta_title' => 'Rammstein в Самаре &middot; 8 июня 2013',
  'meta_description' => 'Заметки о концерте.',
  'meta_image' => 'https://life.ivacuum.ru/gigs/rammstein.2013.06.08.jpg',

  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Концерты', 'url' => 'life/gigs'],
    ['title' => 'Rammstein']
  ]
])

@section('content')
<h2>Rammstein в Самаре <small>8 июня 2013</small></h2>
<div class="row">
  <div class="col-md-7">
    <p>Что играли:</p>
    <ol>
      <li>Ich tu dir weh</li>
      <li>Wollt ihr das Bett in Flammen sehen?</li>
      <li>Keine Lust</li>
      <li>Sehnsucht</li>
      <li>Asche zu Asche</li>
      <li>Feuer frei!</li>
      <li>Mein Teil</li>
      <li>Ohne dich</li>
      <li>Wiener Blut</li>
      <li>Du riechst so gut</li>
      <li>Benzin</li>
      <li>Links 2-3-4</li>
      <li>Du hast</li>
      <li>Bück dich</li>
      <li>Ich will</li>
      <li>Mein Herz brennt</li>
      <li>Sonne</li>
      <li>Pussy</li>
    </ol>
  </div>
  <div class="col-md-5">
    <div class="img-container">
      <img src="//life.ivacuum.ru/gigs/rammstein.2013.06.08.jpg">
    </div>
  </div>
</div>

<p>Видеозапись концерта.</p>
<div class="fotorama" data-width="1280" data-ratio="16/10">
  <a href="https://www.youtube.com/watch?v=enTp6hq2Dqw"></a>
</div>

@include('life.timeline.rammstein')
@stop
