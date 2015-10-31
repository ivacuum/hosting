@extends('life.base', [
  'meta_title' => 'Калуга',
  
  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Калуга'],
  ]
])

@section('content')
<h2>Калуга</h2>
<div class="row">
  <div class="col-xs-6 col-sm-3 col-md-2">
    <h3>2015</h3>
    <ul class="list-unstyled">
      <li><a class="link" href="/life/kaluga.2015.01.01">январь</a></li>
    </ul>
  </div>
  <div class="col-xs-6 col-sm-3 col-md-2">
    <h3>2014</h3>
    <ul class="list-unstyled">
      <li><a class="link" href="/life/kaluga.2014.10">октябрь</a></li>
      <li>август</li>
      <li>июль</li>
      <li>июнь</li>
      <li>март</li>
    </ul>
  </div>
  <div class="col-xs-6 col-sm-3 col-md-2">
    <h3>2013</h3>
    <ul class="list-unstyled">
      <li><a class="link" href="/life/kaluga.2013.12">декабрь</a></li>
      <li>октябрь</li>
      <li><a class="link" href="/life/kaluga.2013.09">сентябрь</a></li>
      <li>август</li>
      <li><a class="link" href="/life/kaluga.2013.01">январь</a></li>
    </ul>
  </div>
</div>
@stop
