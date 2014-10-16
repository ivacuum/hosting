@extends('acp.base')

@section('content')
<div class="pull-right">
	{{ Form::open(['route' => ['acp.clients.destroy', $client->id], 'method' => 'delete']) }}
	  <div class="form-group">
	    {{ Form::submit('Удалить клиента', ['class' => 'btn btn-default']) }}
	  </div>
	{{ Form::close() }}
</div>
<h2>
	<a href="{{ route('acp.clients.index') }}"><span class="glyphicon glyphicon-chevron-left"></span></a>
	{{ $client->name }}
	<a class="btn btn-default" href="{{ route('acp.clients.edit', $client->id) }}">
		<span class="glyphicon glyphicon-pencil"></span>
	</a>
</h2>

@if ($client->text)
	<blockquote>{{ nl2br($client->text) }}</blockquote>
@endif

@if (sizeof($client->domains))
	<div class="row">
		<div class="col-md-3">
			<p>
				Доменов у клиента
				<br>
				<samp class="text-counter">{{ sizeof($client->domains) }}</samp>
			</p>
		</div>
	</div>

	@include('acp.domains.list', ['domains' => $client->domains])
@else
	<div class="alert alert-warning">У клиента еще нет доменов.</div>
@endif
@stop