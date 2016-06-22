@extends('acp.base')

@section('content')
<div class="pull-right">
  @include('acp.tpl.delete', ['id' => $server])
</div>
<h2>
  @include('acp.tpl.back')
  {{ $server->title }}
  <small>{{ $server->host }}</small>
  @include('acp.tpl.edit', ['id' => $server])
  <a class="btn btn-default" href="{{ action("$self\Ftp@index", [$server]) }}">FTP</a>
</h2>

@if ($server->text)
  <div>{!! nl2br($server->text) !!}</div>
@endif
@endsection
