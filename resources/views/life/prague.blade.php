@extends('life.base', [
  'meta_title' => 'Прага',

  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Прага'],
  ]
])

@section('content')
<h2>
  <span class="emoji">&#x1f1e8;&#x1f1ff;</span>
  Прага
</h2>
<div class="row">
  <div class="col-xs-6 col-sm-3 col-md-2">
    <h3>2015</h3>
    <ul class="list-unstyled">
      <li>март-апрель</li>
    </ul>
  </div>
</div>

@include('tpl.tickets_calendar', ['origin' => 'mow', 'destination' => 'prg'])
@stop
