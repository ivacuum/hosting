@extends('life.base', [
  'meta_title' => 'Вена',

  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Вена'],
  ]
])

@section('content')
<h2>
  <span class="emoji">&#x1f1e6;&#x1f1f9;</span>
  Вена
</h2>
<div class="row">
  <div class="col-xs-6 col-sm-3 col-md-2">
    <h3>2015</h3>
    <ul class="list-unstyled">
      <li><a class="link" href="/life/vienna.2015">декабрь</a></li>
    </ul>
  </div>
</div>

@include('tpl.tickets_calendar', ['origin' => 'mow', 'destination' => 'vie'])
@stop
