@extends('acp.base')

@section('content_header')
<div class="row">
  <div class="col-sm-3">
    <div class="list-group text-center">
      <a class="list-group-item {{ $view == "$tpl.show" ? 'active' : '' }}" href="{{ action("$self@show", $model) }}">
        {{ trans("$tpl.show") }}
      </a>
      <a class="list-group-item {{ $view == "$tpl.edit" ? 'active' : '' }}" href="{{ action("$self@edit", [$model, 'goto' => Request::fullUrl()]) }}">
        {{ trans("$tpl.edit") }}
      </a>
      <a class="list-group-item {{ $view == "$tpl.whois" ? 'active' : '' }}" href="{{ action("$self@whois", $model) }}">
        {{ trans("$tpl.whois") }}
      </a>
      @if ($model->yandex_user_id)
        <a class="list-group-item {{ $view == "$tpl.mailboxes" ? 'active' : '' }}" href="{{ action("$self@mailboxes", $model) }}">
          {{ trans("$tpl.mailboxes") }}
        </a>
        <a class="list-group-item {{ $view == "$tpl.ns_records" ? 'active' : '' }}" href="{{ action("$self@nsRecords", $model) }}">
          {{ trans("$tpl.ns_records") }}
        </a>
      @endif
      <a class="list-group-item" href="http://{{ $model->domain }}/">
        {{ $model->domain }}
        @svg (external-link)
      </a>
      <a class="list-group-item {{ $view == "$tpl.robots" ? 'active' : '' }}" href="{{ action("$self@robots", $model) }}">
        {{ trans("$tpl.robots") }}
      </a>
      @include('acp.tpl.delete')
    </div>
  </div>
  <div class="col-md-9">
    <h2 class="mt-0">
      @include('acp.tpl.back')
      {{ $model->domain }}
      @if (!$model->isExpired() && ($model->cms_url || ($model->alias_id && $model->alias->cms_url)))
        @include("$tpl.cms_login", ['cms_button_class' => 'btn btn-default'])
      @endif
    </h2>
@endsection

@section('content_footer')
  </div>
</div>
@endsection
