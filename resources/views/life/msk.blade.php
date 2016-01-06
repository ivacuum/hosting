@extends('life.base', [
  'meta_title' => 'Москва',

  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Москва'],
  ]
])

@section('content')
<h2>
  <span class="emoji">&#x1f1f7;&#x1f1fa;</span>
  Москва
</h2>
<div class="row">
  <div class="col-xs-6 col-sm-3 col-md-2">
    <h3>2015</h3>
    <ul class="list-unstyled">
      <li><a class="link" href="/life/msk.2015.07">июль</a></li>
    </ul>
  </div>
  <div class="col-xs-6 col-sm-3 col-md-2">
    <h3>2014</h3>
    <ul class="list-unstyled">
      <li><a class="link" href="/life/msk.2014.12">декабрь</a></li>
      <li>конец ноября</li>
      <li><a class="link" href="/life/msk.2014.11.08">начало ноября</a></li>
      <li><a class="link" href="/life/msk.2014.10">октябрь</a></li>
      <li>февраль</li>
    </ul>
  </div>
  <div class="col-xs-6 col-sm-3 col-md-2">
    <h3>2013</h3>
    <ul class="list-unstyled">
      <li><a class="link" href="/life/msk.2013.09">сентябрь</a></li>
    </ul>
  </div>
  <div class="col-xs-6 col-sm-3 col-md-2">
    <h3>2012</h3>
    <ul class="list-unstyled">
      <li>апрель</li>
    </ul>
  </div>
</div>
@stop
