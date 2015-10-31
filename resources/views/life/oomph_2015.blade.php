@extends('life.base', [
  'meta_title' => 'Oomph! в Москве &middot; 4 ноября 2015',
  'meta_description' => 'Заметки о концерте.',
  'meta_image' => 'https://life.ivacuum.ru/gigs/oomph.2015.11.04.jpg',

  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Концерты', 'url' => 'life/gigs'],
    ['title' => 'Oomph!']
  ]
])

@section('content')
<h2>Oomph! в Москве <small>4 ноября 2015</small></h2>
<div class="row">
  <div class="col-md-7">
    <p>Ждем-с.</p>
  </div>
  <div class="col-md-5">
    <div class="img-container">
      <img src="//life.ivacuum.ru/gigs/oomph.2015.11.04.jpg">
    </div>
  </div>
</div>

@include('life.timeline.oomph')
@stop
