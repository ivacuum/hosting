@extends('base')

@section('content')
<p><a href="{{ URL::route('domains.index') }}">&larr; Вернуться к списку доменов</a></p>

<h1>{{ $domain->domain }}</h1>
<p><strong>ipv4</strong>: {{ $domain->ipv4 }}</p>
@if ($domain->ipv6)
  <p><strong>ipv6</strong>: {{ $domain->ipv6 }}</p>
@endif
<p><strong>mx</strong>: {{ $domain->mx }}</p>
<p><strong>ns</strong>: {{ $domain->ns }}</p>

<h2>Whois</h2>
<pre>{{ $domain->getWhoisData() }}</pre>
@stop