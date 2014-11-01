@extends('base')

@section('content')
<h1>Papertrail events log</h1>
<ul class="nav nav-pills nav-justified">
  <li class="active"><a href="papertrail">Все</a></li>
  <li><a href="papertrail?system_id=srv1.ivacuum.ru">srv1.ivacuum.ru</a></li>
  <li><a href="papertrail?system_id=srv2.ivacuum.ru">srv2.ivacuum.ru</a></li>
  <li><a href="papertrail?system_id=srv1.korden.net">srv1.korden.net</a></li>
  <li><a href="papertrail?system_id=srv2.korden.net">srv2.korden.net</a></li>
  <li><a href="papertrail?system_id=srv3.korden.net">srv3.korden.net</a></li>
  <li><a href="papertrail?system_id=bsd.korden.net">bsd.korden.net</a></li>
</ul>
<samp><small>
  @foreach ($events as $event)
    <span class="text-muted">{{ $event->display_received_at }}</span>
    <span class="bg-warning text-warning">{{ $event->hostname }}</span>
    <span class="text-primar">{{ $event->message }}</span>
    <br>
  @endforeach
</small></samp>
@stop