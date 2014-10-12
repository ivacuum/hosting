@extends('acp.base')

@section('content')
<h2>{{ $client->name }}</h2>
<p>{{ nl2br($client->text) }}</p>
<div class="row">
	<div class="col-md-3">
		<p>
			Доменов у клиента
			<br>
			<samp class="text-counter">{{ sizeof($client->domains) }}</samp>
		</p>
	</div>
</div>

@include('domains.list', ['domains' => $client->domains])
@stop