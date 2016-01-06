@extends('life.base', [
  'meta_title' => 'Санкт-Петербург',

  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Санкт-Петербург'],
  ]
])

@section('content')
<h2>
  <span class="emoji">&#x1f1f7;&#x1f1fa;</span>
  Санкт-Петербург
</h2>
<div class="row">
  <div class="col-xs-6 col-sm-3 col-md-2">
    <h3>2015</h3>
    <ul class="list-unstyled">
      <li>октябрь</li>
      <li><a class="link" href="/life/spb.2015.08">август</a></li>
    </ul>
  </div>
  <div class="col-xs-6 col-sm-3 col-md-2">
    <h3>2014</h3>
    <ul class="list-unstyled">
      <li><a class="link" href="/life/spb.2014.09">сентябрь</a></li>
      <li>май</li>
      <li>февраль</li>
    </ul>
  </div>
  <div class="col-xs-6 col-sm-3 col-md-2">
    <h3>2010</h3>
    <ul class="list-unstyled">
      <li>февраль</li>
    </ul>
  </div>
  <div class="col-xs-6 col-sm-3 col-md-2">
    <h3>2008</h3>
    <ul class="list-unstyled">
      <li>июль</li>
    </ul>
  </div>
</div>

@include('tpl.tickets_calendar', ['destination' => 'led'])
@stop
