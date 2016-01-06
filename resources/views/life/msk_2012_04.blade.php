@extends('life.base', [
  'breadcrumbs' => [
    ['title' => 'Заметки', 'url' => 'life'],
    ['title' => 'Москва', 'url' => 'life/msk'],
    ['title' => '30 апреля 2012']
  ]
])

@section('content')
<h2>
  <span class="emoji">&#x1f1f7;&#x1f1fa;</span>
  Москва
  <small>30 апреля 2012</small>
</h2>
@stop
