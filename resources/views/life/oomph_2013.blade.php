@extends('life.base', [
  'meta_title' => 'Oomph! в Москве &middot; 19 октября 2013',
  'meta_description' => 'Заметки о концерте.',
  'meta_image' => 'https://life.ivacuum.ru/gigs/oomph.2013.10.19.jpg',

  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Концерты', 'url' => 'life/gigs'],
    ['title' => 'Oomph!']
  ]
])

@section('content')
<h2>Oomph! в Москве <small>19 октября 2013</small></h2>
<div class="row">
  <div class="col-md-7">
    <p>Что играли:</p>
    <ol>
      <li>Unzerstörbar</li>
      <li>Labyrinth</li>
      <li>Mein Schatz</li>
      <li>Das weisse Licht</li>
      <li>Bis Der Spiegel Zerbricht</li>
      <li>Träumst Du</li>
      <li>Kleinstadtboy</li>
      <li>Mein Herz</li>
      <li>Der neue Gott</li>
      <li>Regen</li>
      <li>Niemand</li>
      <li>Gekreuzigt</li>
      <li>Seemannsrose</li>
      <li>Mitten ins Herz</li>
      <li>Auf Kurs</li>
      <li>Sex hat keine Macht</li>
      <li>Zwei Schritte Vor</li>
      <li>Sandmann</li>
      <li>Augen auf!</li>
      <li>Gott ist ein Popstar</li>
    </ol>
  </div>
  <div class="col-md-5">
    <div class="img-container">
      <img src="//life.ivacuum.ru/gigs/oomph.2013.10.19.jpg">
    </div>
  </div>
</div>

<p>Видеозапись выступления:</p>
<div class="fotorama" data-width="1280" data-ratio="16/10">
  <a href="https://www.youtube.com/watch?v=RsLFgW-wsP0"></a>
</div>

@include('life.timeline.oomph')
@endsection
