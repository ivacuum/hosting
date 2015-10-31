@extends('life.base', [
  'meta_title' => 'Якутск',

  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Якутск'],
  ]
])

@section('content')
<h2>Якутск</h2>
<div class="row">
  <div class="col-xs-6 col-sm-3 col-md-2">
    <h3>2014</h3>
    <ul class="list-unstyled">
      <li>июнь</a></li>
    </ul>
  </div>
  <div class="col-xs-6 col-sm-3 col-md-2">
    <h3>2012</h3>
    <ul class="list-unstyled">
      <li>сентябрь</li>
      <li>июнь</li>
    </ul>
  </div>
  <div class="col-xs-6 col-sm-3 col-md-2">
    <h3>2011</h3>
    <ul class="list-unstyled">
      <li>июль</li>
    </ul>
  </div>
</div>

@include('tpl.tickets_calendar', ['origin' => 'mow', 'destination' => 'yks'])
@stop
