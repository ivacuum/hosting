@extends('life.base', [
  'meta_title' => 'Калуга &middot; 6 октября 2014',
  'meta_description' => 'Заметки о прогулке.',
  'meta_image' => 'https://life.ivacuum.ru/kaluga.2014.10/IMG_1250.jpg',

  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Калуга', 'url' => 'life/kaluga'],
    ['title' => '6 октября 2014']
  ]
])

@section('content')
<h2>
  <span class="emoji">&#x1f1f7;&#x1f1fa;</span>
  Калуга
  <small>6 октября 2014</small>
</h2>
<p>Пара ночных снимков.</p>
<div class="fotorama">
  <img src="//life.ivacuum.ru/kaluga.2014.10/IMG_1250.jpg">
  <img src="//life.ivacuum.ru/kaluga.2014.10/IMG_1247.jpg">
</div>
@stop
