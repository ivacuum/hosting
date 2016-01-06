@extends('life.base', [
  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Санкт-Петербург', 'url' => 'life/spb'],
    ['title' => '26–28 февраля 2014']
  ]
])

@section('content')
<h2>
  <span class="emoji">&#x1f1f7;&#x1f1fa;</span>
  Санкт-Петербург
  <small>26–28 февраля 2014</small>
</h2>
@stop
