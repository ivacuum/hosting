@extends('life.gigs.base', [
  'meta_title' => 'Metallica в Санкт-Петербурге &middot; 25 августа 2015',
  'meta_description' => 'Заметки о концерте.',
  'meta_image' => 'https://life.ivacuum.ru/gigs/metallica.2015.08.25.jpg',

  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Концерты', 'url' => 'life/gigs'],
    ['title' => 'Metallica']
  ]
])

@section('content')
<h2>Metallica в Санкт-Петербурге <small>25 августа 2015</small></h2>
<div class="row">
  <div class="col-md-7">
    <p lang="ru">Вспоминал как была заполнена площадка <a class="link" href="/life/metallica.2008">семь лет назад</a> во время их шоу, боялся повторения тех адовых условий и духоты. По большому счету они повторились, но самому теперь перенести их было гораздо проще — семь лет подготовки на других концертах дали о себе знать.</p>
    <p lang="ru">Отличная затея начать шоу с заводной песни Fuel. Побольше бы групп делало ставку на активное начало. В целом сет очень понравился, особенно King Nothing и Turn the Page. Вяло зашли зашли The Frayed Ends of Sanity и Nothing Else Matters.</p>
    <p lang="ru">Что играли:</p>
    <ol>
      <li>Fuel</li>
      <li>For Whom the Bell Tolls</li>
      <li>Blackened</li>
      <li>King Nothing</li>
      <li>Disposable Heroes</li>
      <li>The Day That Never Comes</li>
      <li>The Memory Remains</li>
      <li>The Unforgiven</li>
      <li>Sad But True</li>
      <li>Turn the Page</li>
      <li>The Frayed Ends of Sanity</li>
      <li>One</li>
      <li>Master of Puppets</li>
      <li>Fade to Black</li>
      <li>Seek and Destroy</li>
      <li>Whiskey in the Jar</li>
      <li>Nothing Else Matters</li>
      <li>Enter Sandman</li>
    </ol>
  </div>
  <div class="col-md-5">
    <div class="img-container">
      <img src="//life.ivacuum.ru/gigs/metallica.2015.08.25.jpg">
    </div>
  </div>
</div>

<p lang="ru">Каково оно было в фан-зоне:</p>
<div class="fotorama" data-width="720" data-ratio="16/10">
  <a href="https://www.youtube.com/watch?v=WkVGeBGM5yc"></a>
</div>

<p lang="ru">Вообще у <a class="link" href="http://www.youtube.com/channel/UCGp2uNPZCeUTH1BynWSnSUQ/search?query=metallica+2015">этого товарища</a> отличные атмосферные видео вышли. У <a class="link" href="http://www.youtube.com/watch?v=EmCVvp3KbjQ">Sad But True</a>, например, крутое начало — прямо как в 2008 году.</p>

<p lang="ru">Кирк Хэмметт <a class="link" href="https://www.youtube.com/watch?v=eUr9c8b7d64&t=1525">поразил своим вторым соло</a> — никогда его не видел таким эмоциональным и заведенным! Самое яркое впечатление вечера!</p>

<p lang="ru">Видеозапись концерта.</p>
<div class="fotorama" data-width="1000" data-ratio="16/10">
  <a href="https://www.youtube.com/watch?v=-VQMs8zQRj8"></a>
</div>

@include('life.timeline.metallica')
@endsection
