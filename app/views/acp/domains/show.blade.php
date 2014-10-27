@extends('base', [
  'meta_title' => $domain->domain,
])

@section('content')
<div class="pull-right">
  {{ Form::open(['route' => ['acp.domains.destroy', $domain->domain], 'method' => 'delete']) }}
    <div class="form-group">
      <button class="btn btn-default js-confirm" data-confirm="Запись будет удалена. Продолжить?" type="submit">
        <span class="glyphicon glyphicon-trash"></span>
      </button>
    </div>
  {{ Form::close() }}
</div>
<h2>
  <a href="{{ route('acp.domains.index') }}"><span class="glyphicon glyphicon-chevron-left"></span></a>
  {{ $domain->domain }}
  <a class="btn btn-default" href="http://{{ $domain->domain }}/" target="_blank">
    <span class="glyphicon glyphicon-globe"></span>
  </a>
  <a class="btn btn-default" href="{{ route('acp.domains.edit', [$domain->domain, 'goto' => Request::path()]) }}">
    <span class="glyphicon glyphicon-pencil"></span>
  </a>
  @if ($domain->cms_url)
    @include('acp.domains.cms_login', ['cms_button_class' => 'btn btn-default'])
  @endif
</h2>
<div style="margin: 1em 0;">
  <samp style="white-space: pre;"><strong>client</strong>: <a href="{{ route('acp.clients.show', $domain->client->id) }}">{{ $domain->client->name }}</a>
<strong>ipv4</strong>:   {{ $domain->ipv4 }}
@if ($domain->ipv6)
<strong>ipv6</strong>:   {{ $domain->ipv6 }}
@endif
<strong>mx</strong>:     {{ $domain->mx }}
<strong>ns</strong>:     {{ $domain->ns }}</samp>
</div>

@if ($domain->domain_control and $domain->ns != 'dns1.yandex.net dns2.yandex.net')
  {{ Form::open(['route' => ['acp.domains.set-yandex-ns', $domain->domain]]) }}
  <p>
    <button type="submit" class="btn btn-default">
      Установить днс Яндекса
    </button>
  </p>
  {{ Form::close() }}
@endif

<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title">Whois</h3>
  </div>
  <div class="panel-body">
    <samp class="js-deferred-load" data-deferred-url="{{ route('acp.domains.whois', $domain->domain) }}">Идет загрузка...</samp>
  </div>
</div>
@stop
