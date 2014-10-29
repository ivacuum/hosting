@extends('base', [
  'meta_title' => 'Домены',
])

@section('content')
<ul class="nav nav-pills" style="margin: 0 0 0.5em;">
  <li class="{{ !$filter ? 'active' : '' }}">
    <a href="{{ action("$self@index") }}">
      Активные
    </a>
  </li>
  <li class="{{ $filter == 'external' ? 'active' : '' }}">
    <a href="{{ action("$self@index", ['filter' => 'external']) }}">
      <span class="glyphicon glyphicon-filter"></span>
      Внешние
    </a>
  </li>
  <li class="{{ $filter == 'no-server' ? 'active' : '' }}">
    <a href="{{ action("$self@index", ['filter' => 'no-server']) }}">
      <span class="glyphicon glyphicon-filter"></span>
      Без сервера
    </a>
  </li>
  <li class="{{ $filter == 'no-ns' ? 'active' : '' }}">
    <a href="{{ action("$self@index", ['filter' => 'no-ns']) }}">
      <span class="glyphicon glyphicon-filter"></span>
      Без NS
    </a>
  </li>
  <li class="{{ $filter == 'inactive' ? 'active' : '' }}">
    <a href="{{ action("$self@index", ['filter' => 'inactive']) }}">
      <span class="glyphicon glyphicon-filter"></span>
      Неактивные
    </a>
  </li>
</ul>

@include("$tpl.list")
@stop
