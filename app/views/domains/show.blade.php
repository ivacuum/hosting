@extends('base')

@section('content')
<p><a href="{{ route('domains.index') }}">&larr; Вернуться к списку доменов</a></p>

<h2>{{ $domain->domain }}</h2>
<div style="margin: 1em 0;">
  <samp style="white-space: pre;"><strong>client</strong>: {{ $domain->client->name }} [<a href="{{ route('acp.clients.show', $domain->client->id) }}">о клиенте</a>]
<strong>ipv4</strong>:   {{ $domain->ipv4 }}
@if ($domain->ipv6)
<strong>ipv6</strong>:   {{ $domain->ipv6 }}
@endif
<strong>mx</strong>:     {{ $domain->mx }}
<strong>ns</strong>:     {{ $domain->ns }}</samp>
</div>

<p><a class="btn btn-primary" href="{{ route('domains.edit', $domain->domain) }}">Редактировать информацию о домене</a></p>

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Whois</h3>
  </div>
  <div class="panel-body">
    <samp class="js-deferred-load" data-deferred-url="{{ route('domains.whois', $domain->domain) }}">Идет загрузка...</samp>
  </div>
</div>

{{ Form::open(['route' => ['domains.destroy', $domain->domain], 'method' => 'delete']) }}

  <div class="form-group">
    {{ Form::submit('Удалить домен', ['class' => 'btn btn-danger']) }}
  </div>

{{ Form::close() }}

@stop
