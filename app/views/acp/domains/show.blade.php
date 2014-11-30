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

<ul class="list-inline" style="margin-top: 2em;">
  <li>
    <h3>
      <a class="active pseudo js-ajax" data-ajax-url="{{ action("$self@whois", $domain->domain) }}">
        Whois
      </a>
    </h3>
  </li>
  @if ($domain->yandex_user_id)
    <li>
      <h3>
        <a class="pseudo js-ajax">
          Почта
        </a>
      </h3>
    </li>
    <li>
      <h3>
        <a class="pseudo js-ajax" data-ajax-url="{{ action("$self@nsRecords", $domain->domain) }}">
          DNS
        </a>
      </h3>
    </li>
  @endif
</ul>

<div id="ajax_container" class="js-deferred-load" data-deferred-url="{{ action("$self@whois", $domain->domain) }}">
  Идет загрузка...
</div>
@stop
