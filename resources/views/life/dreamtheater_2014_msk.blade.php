@extends('life.gigs.base', [
  'meta_title' => 'Dream Theater в Москве &middot; 28 февраля 2014',
  'meta_description' => 'Заметки о концерте.',
  'meta_image' => 'https://life.ivacuum.ru/gigs/dreamtheater.2014.02.28.jpg',

  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Концерты', 'url' => 'life/gigs'],
    ['title' => 'Dream Theater']
  ]
])

@section('content')
<h2>Dream Theater в Москве <small>28 февраля 2014</small></h2>
<div class="row">
  <div class="col-md-7">
    <p lang="ru">Впервые побывал на двух концертах группы подряд.</p>
    <p lang="ru">Что играли:</p>
    <ol>
      <li>The Enemy Inside</li>
      <li>The Shattered Fortress</li>
      <li>On the Backs of Angels</li>
      <li>The Looking Glass</li>
      <li>Trial of Tears</li>
      <li>Enigma Machine</li>
      <li>Along for the Ride</li>
      <li>Breaking All Illusions</li>
      <li>The Mirror</li>
      <li>Lie</li>
      <li>Lifting Shadows Off a Dream</li>
      <li>Scarred</li>
      <li>Space-Dye Vest</li>
      <li>Illumination Theory</li>
      <li>Overture 1928</li>
      <li>Strange Déjà Vu</li>
      <li>The Dance of Eternity</li>
      <li>Finally Free</li>
    </ol>
  </div>
  <div class="col-md-5">
    <div class="img-container">
      <img src="//life.ivacuum.ru/gigs/dreamtheater.2014.02.28.jpg">
    </div>
  </div>
</div>

@include('life.timeline.dreamtheater')
@endsection
