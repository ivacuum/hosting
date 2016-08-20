@extends('life.gigs.base', [
  'meta_title' => 'Dream Theater в Москве &middot; 3 июля 2015',
  'meta_description' => 'Заметки о концерте.',
  'meta_image' => 'https://life.ivacuum.ru/gigs/dreamtheater.2015.07.03.jpg',

  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Концерты', 'url' => 'life/gigs'],
    ['title' => 'Dream Theater']
  ]
])

@section('content')
<h2>Dream Theater в Москве <small>3 июля 2015</small></h2>
<div class="row">
  <div class="col-md-7">
    <p lang="ru">Фестиваль музыки в стиле прогрессив метал с хэдлайнерами в лице Дрим Театра. Ограничение по времени фестивальных выступлений коснулось и их — сет был всего на полтора часа, когда <a class="link" href="/life/dreamtheater.2014.spb">годом ранее</a> они играли три.</p>
    <p lang="ru">Укрепилось впечатление, что музыкантам Москва нравится больше Питера по их активности на соответствующих шоу и вниманию к публике.</p>
    <p lang="ru">Интересно составлен сет — по одной песне с каждого выпущенного альбома с 1989 по 2013 годы. Молодцы, что вернули в программу As I Am и Panic Attack — их нехватало с <a class="link" href="/life/dreamtheater.2009">2009 года</a>.</p>
    <p lang="ru">Что играли:</p>
    <ol>
      <li>Afterlife</li>
      <li>Metropolis Pt. 1: The Miracle and the Sleeper</li>
      <li>Caught in a Web</li>
      <li>A Change of Seasons: II Innocence</li>
      <li>Burning My Soul</li>
      <li>The Spirit Carries On</li>
      <li>About to Crash</li>
      <li>As I Am</li>
      <li>Panic Attack</li>
      <li>Constant Motion</li>
      <li>Wither</li>
      <li>Bridges in the Sky</li>
      <li>Behind the Veil</li>
    </ol>
  </div>
  <div class="col-md-5">
    <div class="img-container">
      <img src="//life.ivacuum.ru/gigs/dreamtheater.2015.07.03.jpg">
    </div>
  </div>
</div>

<p lang="ru">Несколько фото с концерта.</p>
<div class="fotorama">
  <img src="//life.ivacuum.ru/gigs/dreamtheater.2015/IMG_1682.jpg">
  <img src="//life.ivacuum.ru/gigs/dreamtheater.2015/IMG_1688.jpg">
  <img src="//life.ivacuum.ru/gigs/dreamtheater.2015/IMG_1689.jpg">
</div>

<p lang="ru">Видеозапись выступления:</p>
<div class="fotorama" data-width="1280" data-ratio="16/10">
  <a href="https://www.youtube.com/watch?v=w0ZYxUeKsu8"></a>
</div>
@include('life.timeline.dreamtheater')
@endsection
