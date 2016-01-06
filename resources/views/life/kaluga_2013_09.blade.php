@extends('life.base', [
  'meta_title' => 'Калуга &middot; сентябрь 2013',
  'meta_description' => 'Заметки о прогулках.',
  'meta_image' => 'https://life.ivacuum.ru/kaluga.2013.09/IMG_0242.jpg',

  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Калуга', 'url' => 'life/kaluga'],
    ['title' => 'Сентябрь 2013']
  ]
])

@section('content')
<h2>
  <span class="emoji">&#x1f1f7;&#x1f1fa;</span>
  Калуга
  <small>сентябрь 2013</small>
</h2>
<p>Общественный траспорт сближает калужан.</p>
<div class="img-container">
  <img src="//life.ivacuum.ru/kaluga.2013.09/IMG_0212.jpg">
</div>

<p>Осень.</p>
<div class="fotorama">
  <img src="//life.ivacuum.ru/kaluga.2013.09/IMG_0242.jpg">
  <img src="//life.ivacuum.ru/kaluga.2013.09/IMG_0232.jpg">
</div>
@stop
