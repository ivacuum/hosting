@extends('base', [
  'meta_title' => $domain->domain,
])

@section('content')
<div class="pull-right">
  {{ Form::open(['action' => ["$self@destroy", $domain->domain], 'method' => 'delete']) }}
    <div class="form-group">
      <button class="btn btn-default js-confirm" data-confirm="Запись будет удалена. Продолжить?" type="submit">
        <span class="glyphicon glyphicon-trash"></span>
      </button>
    </div>
  {{ Form::close() }}
</div>
<h2>
  <a href="{{ action("$self@index") }}"><span class="glyphicon glyphicon-chevron-left"></span></a>
  {{ $domain->domain }}
  <a class="btn btn-default" href="http://{{ $domain->domain }}/" target="_blank">
    <span class="glyphicon glyphicon-globe"></span>
  </a>
  <a class="btn btn-default" href="{{ action("$self@edit", [$domain->domain, 'goto' => Request::path()]) }}">
    <span class="glyphicon glyphicon-pencil"></span>
  </a>
  @if ($domain->cms_url)
    @include("$tpl.cms_login", ['cms_button_class' => 'btn btn-default'])
  @endif
</h2>
<div style="margin: 1em 0;">
  <samp style="white-space: pre;"><strong>client</strong>: <a href="{{ action('Acp\Clients@show', $domain->client->id) }}" class="link">{{ $domain->client->name }}</a>
@if ($domain->yandex_user_id)
<strong>yandex</strong>: {{ $domain->yandexUser->account }}
@endif
<strong>ipv4</strong>:   {{ $domain->ipv4 }}
@if ($domain->ipv6)
<strong>ipv6</strong>:   {{ $domain->ipv6 }}
@endif
<strong>mx</strong>:     {{ $domain->mx }}
<strong>ns</strong>:     {{ $domain->ns }}</samp>
</div>

@if ($domain->domain_control and $domain->ns != 'dns1.yandex.net dns2.yandex.net')
  {{ Form::open(['action' => ["$self@setYandexNs", $domain->domain]]) }}
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
    <samp class="js-deferred-load" data-deferred-url="{{ action("$self@whois", $domain->domain) }}">Идет загрузка...</samp>
  </div>
</div>

@if ($domain->yandex_user_id)
  <div class="js-deferred-load ns-records-container" data-deferred-url="{{ action("$self@nsRecords", $domain->domain) }}"></div>
@endif
@stop
