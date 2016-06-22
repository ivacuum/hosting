@extends('life.base', [
  'meta_title' => 'Tides from Nebula в Москве &middot; 21 декабря 2014',
  'meta_description' => 'Заметки о концерте.',
  'meta_image' => 'https://life.ivacuum.ru/gigs/tfn.2014.12.21.jpg',

  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Концерты', 'url' => 'life/gigs'],
    ['title' => 'Tides from Nebula']
  ]
])

@section('content')
<h2>Tides from Nebula в Москве <small>21 декабря 2014</small></h2>
<div class="row">
  <div class="col-md-7">
    <p>На концерте всего было около полутора сотен человек — никогда прежде не был на столь малочисленных шоу.</p>
    <p>Что играли:</p>
    <ol>
      <li>Sleepmonster</li>
      <li>Hollow Lights</li>
      <li>Only With Presence</li>
      <li>It Takes More Than One Kind of Telescope to See the Light</li>
      <li>Purr</li>
      <li>Laughter of Gods</li>
      <li>Satori</li>
      <li>The Fall of Leviathan</li>
      <li>When There Were No Connections</li>
      <li>Now Run</li>
      <li>Siberia</li>
      <li>Tragedy of Joseph Merrick</li>
    </ol>
  </div>
  <div class="col-md-5">
    <div class="img-container">
      <img src="//life.ivacuum.ru/gigs/tfn.2014.12.21.jpg">
    </div>
  </div>
</div>
@endsection
