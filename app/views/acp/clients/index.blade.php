@extends('base')

@section('content')
<ul>
  @foreach ($clients as $client)
    <li><a href="{{ route('acp.clients.show', $client->id) }}">{{ $client->name }}</a></li>
  @endforeach
</ul>
@stop