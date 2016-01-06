@extends('life.base', [
  'meta_title' => 'Калуга &middot; 29 декабря 2013',
  'meta_description' => 'Заметки о прогулках.',
  'meta_image' => 'https://life.ivacuum.ru/kaluga.2013.12/IMG_0339.jpg',

  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Калуга', 'url' => 'life/kaluga'],
    ['title' => '29 декабря 2013']
  ]
])

@section('content')
<h2>
  <span class="emoji">&#x1f1f7;&#x1f1fa;</span>
  Калуга
  <small>29 декабря 2013</small>
</h2>
<p>Сходу и не скажешь, что через пару дней наступит новый год.</p>
<div class="fotorama">
  <img src="//life.ivacuum.ru/kaluga.2013.12/IMG_0339.jpg">
  <img src="//life.ivacuum.ru/kaluga.2013.12/IMG_0340.jpg">
</div>
@stop
