@extends('life.base', [
  'meta_title' => 'Rammstein в Берлине &middot; 9 июля 2016',
  'meta_description' => 'Заметки о концерте.',
  'meta_image' => 'https://life.ivacuum.ru/gigs/rammstein.2016.07.09.jpg',

  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Концерты', 'url' => 'life/gigs'],
    ['title' => 'Rammstein']
  ]
])

@section('content')
<h2>Rammstein в Берлине <small>9 июля 2016</small></h2>
<div class="row">
  <div class="col-md-7">
    <p>Единственные сольные выступления в туре 2016 года состоялись в Берлине, Waldbühne.</p>
    <p>Что играли:</p>
    <ol>
      <li>Ramm 4</li>
      <li>Reise, Reise</li>
      <li>Hallelujah</li>
      <li>Zerstören</li>
      <li>Keine Lust</li>
      <li>Feuer frei!</li>
      <li>Seemann</li>
      <li>Ich tu dir weh</li>
      <li>Du riechst so gut</li>
      <li>Mein Herz brennt</li>
      <li>Links 2-3-4</li>
      <li>Ich will</li>
      <li>Du hast</li>
      <li>Stripped</li>
      <li>Sonne</li>
      <li>Amerika</li>
      <li>Engel</li>
    </ol>
  </div>
  <div class="col-md-5">
    <div class="img-container">
      <img src="https://life.ivacuum.ru/gigs/rammstein.2016.07.09.jpg">
    </div>
  </div>
</div>

@include('life.timeline.rammstein')
@endsection
