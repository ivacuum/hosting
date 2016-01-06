@extends('life.base', [
  'meta_title' => 'Казань',

  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Казань'],
  ]
])

@section('content')
<h2>
  <span class="emoji">&#x1f1f7;&#x1f1fa;</span>
  Казань
</h2>
<div class="row">
  <div class="col-xs-6 col-sm-3 col-md-2">
    <h3>2015</h3>
    <ul class="list-unstyled">
      <li><a class="link" href="/life/kazan.2015">июнь</a></li>
    </ul>
  </div>
</div>

@include('tpl.tickets_calendar', ['origin' => 'mow', 'destination' => 'kzn'])
@stop
