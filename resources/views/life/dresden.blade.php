@extends('life.base', [
  'meta_title' => 'Дрезден',

  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Дрезден'],
  ]
])

@section('content')
<h2>
  <span class="emoji">&#x1f1e9;&#x1f1ea;</span>
  Дрезден
</h2>
<div class="row">
  <div class="col-xs-6 col-sm-3 col-md-2">
    <h3>2015</h3>
    <ul class="list-unstyled">
      <li><a class="link" href="/life/dresden.2015">декабрь</a></li>
    </ul>
  </div>
</div>

@include('tpl.tickets_calendar', ['origin' => 'mow', 'destination' => 'drs'])
@stop
