@extends('acp.base')

@section('content_header')
<div class="row m-t-2">
  <div class="col-sm-3">
    <div class="list-group list-group-svg">
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
      <a class="list-group-item {{ $view == "$tpl.robots" ? 'active' : '' }}" href="{{ action("$self@robots", $model) }}">
        {{ trans("$tpl.robots") }}
      </a>
    </div>
  </div>
  <div class="col-md-9">
    <div class="pull-right">
      @include('acp.tpl.delete', ['id' => $model])
    </div>
    <h2 class="m-t-0">
      @include('acp.tpl.back')
      {{ $model->domain }}
      <a class="btn btn-default" href="http://{{ $model->domain }}/" target="_blank">
        @php (require base_path('resources/svg/external-link.html'))
      </a>
      @include('acp.tpl.edit', ['id' => $model, 'goto' => Request::path()])
      @if (!$model->isExpired() && ($model->cms_url || ($model->alias_id and $model->alias->cms_url)))
        @include("$tpl.cms_login", ['cms_button_class' => 'btn btn-default'])
      @endif
    </h2>
@endsection

@section('content_footer')
  </div>
</div>
@endsection
