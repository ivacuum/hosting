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

@php ($slug = 'gigs/rammstein.2016.07')

@section('content')
<h2>Rammstein в Берлине <small>9 июля 2016</small></h2>
<p>Единственные сольные выступления в туре 2016 года состоялись в Берлине, в лесном театре Вальдбюне. Впервые довелось посетить европейский концерт. Подошел за два с лишним часа до начала, думал рано.</p>
<a name="beer_guy"></a>
@include('tpl.pic-2x', ['pic' => 'IMG_0738.jpg'])

<p>Как бы не так — почти все уже было забито, особенно внизу.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0739.jpg'])

<p>Билеты были именные, их стоимость одна и фиксированная. Можно было занимать любое место. На фото заметно, что сидячий центр пуст — это места для гостей группы. В тот вечер, например, там был <a class="link" href="https://www.facebook.com/TilSchweiger/videos/851172451680093/">Тиль Швайгер</a>.</p>

<div class="row">
  <div class="col-md-7">
    <p>Теперь о самом шоу. Публика достаточно пассивная, если сравнивать с русской. Рук мало, прыгали мало. В этом плюс с точки зрения обзора — он всегда прекрасный. Однако, угнетает, что мало движухи. Площадка шикарная! Много людей с атрибутикой — каждая вторая машина на подъезде была украшена стикерами, чего уж говорить про одежду.</p>
    <p>Звук был куда громче московского, в отдельные моменты закладывало уши. Сложно было разобрать как громко подпевали люди, понять удалось только на записи — вполне достойно пели, но <a class="link" href="/life/rammstein.2016.06">Москва</a> все равно кажется громче.</p>
    <p>Продавали пиво, как на <a class="link" href="/life/rammstein.2013">Роке над Волгой</a>. Нет, еще активнее — ходили и разливали прямо на танцполе (на <a class="pseudo" href="#beer_guy">первой фотографии в заметке</a> видно как — внимание на парня справа). Все напитки наливали в сувенирные стаканы с символикой группы, которые многие потом забрали с собой. Даже салфетки давали с символикой.</p>
    <p>Были некоторые изменения в шоу относительны <a class="link" href="/life/rammstein.2016.06">Москвы</a>. Белый костюм на 1-й песне, на Америке мощнейшее конфетти и прочие мелочи.</p>
    <p>Что играли:</p>
    <ol>
      <li>Ramm 4</li>
      <li>Reise, Reise</li>
      <li>Hallelujah</li>
      <li>Zerstören</li>
      <li>Keine Lust</li>
      <li>Feuer frei!</li>
      <li>
        <a class="link" href="https://www.youtube.com/watch?v=P5PIs7Gf6CU&t=35">Seemann</a>
        @include('tpl.svg.heart')
      </li>
      <li>Ich tu dir weh</li>
      <li>Du riechst so gut</li>
      <li>Mein Herz brennt</li>
      <li>Links 2-3-4</li>
      <li>Ich will</li>
      <li>Du hast</li>
      <li>Stripped</li>
      <li>Sonne</li>
      <li>
        <a class="link" href="https://www.youtube.com/watch?v=M4e_QtzBPmY&t=177">Amerika</a>
        @include('tpl.svg.heart')
      </li>
      <li>Engel</li>
    </ol>
  </div>
  <div class="col-md-5">
    <div class="img-container">
      <img src="https://life.ivacuum.ru/gigs/rammstein.2016.07.09.jpg">
    </div>
  </div>
</div>

<p>Вот что значит распроданы все билеты.</p>
@include('tpl.fotorama', ['pics' => [
  'IMG_0741.jpg',
  'IMG_0742.jpg',
]])

<p>Несколько фотографий Олафа Хайне.</p>
@include('tpl.fotorama', ['pics' => [
  '1.jpg',
  '2.jpg',
]])

<p>Видеозапись концерта.</p>
<div class="fotorama" data-width="1000" data-ratio="16/10">
  <a href="https://www.youtube.com/watch?v=rTsskqnjaIw"></a>
</div>

@include('life.timeline.rammstein')
@endsection
