@extends('life.base', [
  'meta_title' => 'Oomph! в Москве &middot; 24 мая 2012',
  'meta_description' => 'Заметки о концерте.',
  'meta_image' => 'https://life.ivacuum.ru/gigs/oomph.2012.05.24.jpg',

  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Концерты', 'url' => 'life/gigs'],
    ['title' => 'Oomph!']
  ]
])

@section('content')
<h2>Oomph! в Москве <small>24 мая 2012</small></h2>
<div class="row">
  <div class="col-md-7">
    <p>Неожиданно тур в поддержку нового альбома начался в Москве. Сет был неизвестен, к чему готовиться — непонятно. Сюрприз был преподнесен уже на пятой песне — ее дали исполнить залу без музыкального сопровождения. Задача оказалась непростой, так как альбом только-только вышел, и к такому предложению мы не были готовы. Еще Augen auf дважды исполнили.</p>
    <p>Что играли:</p>
    <ol>
      <li>Unzerstörbar</li>
      <li>Beim ersten Mal tut's immer weh</li>
      <li>Träumst Du</li>
      <li>Unsere Rettung</li>
      <li>
        Seemannsrose
        <small class="text-muted">(A Capella)</small>
      </li>
      <li>Fieber</li>
      <li>Wer schön sein will muss leiden</li>
      <li>Das weisse Licht</li>
      <li>
        Augen auf!
        <small class="text-muted">(A Capella with girl from crowd)</small>
      </li>
      <li>Mitten ins Herz</li>
      <li>Zwei Schritte Vor</li>
      <li>
        Sex hat keine Macht
        <small class="text-muted">(Acoustic)</small>
      </li>
      <li>Auf Kurs
        <small class="text-muted">(Acoustic)</small>
      </li>
      <li>Bis Der Spiegel Zerbricht</li>
      <li>Revolution</li>
      <li>Mein Schatz</li>
      <li>Niemand</li>
      <li>Gekreuzigt</li>
      <li>Labyrinth</li>
      <li>Gott ist ein Popstar</li>
      <li>Augen auf!</li>
      <li>Sandmann</li>
      <li>
        The Power of Love
        <small class="text-muted">(Frankie Goes to Hollywood cover) (A Capella)</small>
      </li>
    </ol>
  </div>
  <div class="col-md-5">
    <div class="img-container">
      <img src="//life.ivacuum.ru/gigs/oomph.2012.05.24.jpg">
    </div>
  </div>
</div>

<p>Видеозапись выступления:</p>
<div class="fotorama" data-width="1280" data-ratio="16/10">
  <a href="https://www.youtube.com/watch?v=6WVcvgTBrUk"></a>
</div>

@include('life.timeline.oomph')
@stop
