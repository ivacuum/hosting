@extends('acp.base')

@section('content_header')
<div class="row">
  <div class="col-md-3">
    <div class="list-group">
      <a class="list-group-item js-pjax {{ $view == 'acp.domains.show' ? 'active' : '' }}" href="{{ action("$self@show", $domain) }}">
        Общая информация
      </a>
      <a class="list-group-item js-pjax {{ $view == 'acp.domains.whois' ? 'active' : '' }}" href="{{ action("$self@whois", $domain) }}">
        Whois
      </a>
      @if ($domain->yandex_user_id)
        <a class="list-group-item js-pjax {{ $view == 'acp.domains.mailboxes' ? 'active' : '' }}" href="{{ action("$self@mailboxes", $domain) }}">
          Яндекс-Почта
        </a>
        <a class="list-group-item js-pjax {{ $view == 'acp.domains.ns_records' ? 'active' : '' }}" href="{{ action("$self@nsRecords", $domain) }}">
          Яндекс-DNS
        </a>
      @endif
      <a class="list-group-item js-pjax {{ $view == 'acp.domains.robots' ? 'active' : '' }}" href="{{ action("$self@robots", $domain) }}">
        robots.txt
      </a>
    </div>
  </div>
  <div class="col-md-9">
    <div class="pull-right">
      @include('acp.tpl.delete', ['id' => $domain])
    </div>
    <h2>
      @include('acp.tpl.back')
      {{ $domain->domain }}
      <a class="btn btn-default" href="http://{{ $domain->domain }}/" target="_blank">
        <i class="fa fa-external-link"></i>
      </a>
      @include('acp.tpl.edit', ['id' => $domain, 'goto' => Request::path()])
      @if (!$domain->isExpired() && ($domain->cms_url || ($domain->alias_id and $domain->alias->cms_url)))
        @include("$tpl.cms_login", ['cms_button_class' => 'btn btn-default'])
      @endif
    </h2>
@endsection

@section('content_footer')
  </div>
</div>
@endsection
