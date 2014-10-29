@extends('acp.base')

@section('content')
<div class="pull-right">
	{{ Form::open(['action' => ["$self@destroy", $client->id], 'method' => 'delete']) }}
	  <div class="form-group">
      <button class="btn btn-default js-confirm" data-confirm="Запись будет удалена. Продолжить?" type="submit">
        <span class="glyphicon glyphicon-trash"></span>
      </button>
	  </div>
	{{ Form::close() }}
</div>
<h2>
	<a href="{{ action("$self@index") }}"><span class="glyphicon glyphicon-chevron-left"></span></a>
	{{ $client->name }}
	<a class="btn btn-default" href="{{ action("$self@edit", [$client->id, 'goto' => Request::fullUrl()]) }}">
		<span class="glyphicon glyphicon-pencil"></span>
	</a>
</h2>

@if ($client->text)
	<blockquote>{{ nl2br($client->text) }}</blockquote>
@endif

@if (sizeof($client->domains))
	@include('acp.domains.list', ['domains' => $client->domains])
@else
	<div class="alert alert-warning">У клиента еще нет доменов.</div>
@endif
@stop