@extends('life.base', [
  'meta_title' => 'Калуга &middot; 20 января 2013',
  'meta_description' => 'Заметки о прогулке.',
  'meta_image' => 'https://life.ivacuum.ru/kaluga.2013.01/IMG_2659.jpg',

  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Калуга', 'url' => 'life/kaluga'],
    ['title' => '20 января 2013']
  ]
])

@section('content')
<h2>
  <span class="emoji">&#x1f1f7;&#x1f1fa;</span>
  Калуга
  <small>20 января 2013</small>
</h2>
<p>Город замело снегом.</p>
<div class="fotorama">
  <img src="//life.ivacuum.ru/kaluga.2013.01/IMG_2656.jpg">
  <img src="//life.ivacuum.ru/kaluga.2013.01/IMG_2658.jpg">
  <img src="//life.ivacuum.ru/kaluga.2013.01/IMG_2659.jpg">
  <img src="//life.ivacuum.ru/kaluga.2013.01/IMG_2669.jpg">
</div>
@stop
