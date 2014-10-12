@extends('base')

@section('content')
<h2>{{ $client->name }}</h2>
<p>Владеет доменами:</p>
<ul>
  @foreach ($client->domains as $domain)
    <li>{{ $domain->domain }}</li>
  @endforeach
</ul>
@stop