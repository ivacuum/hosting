@extends('acp.layout')

@section('model_menu')
<a class="list-group-item {{ $view == "$tpl.whois" ? 'active' : '' }}" href="{{ path("$self@whois", $model) }}">
  {{ trans("$tpl.whois") }}
</a>
@if ($model->yandex_user_id)
  <a class="list-group-item {{ $view == "$tpl.mailboxes" ? 'active' : '' }}" href="{{ path("$self@mailboxes", $model) }}">
    {{ trans("$tpl.mailboxes") }}
  </a>
  <a class="list-group-item {{ $view == "$tpl.ns_records" ? 'active' : '' }}" href="{{ path("$self@nsRecords", $model) }}">
    {{ trans("$tpl.ns_records") }}
  </a>
@endif
<a class="list-group-item" href="http://{{ $model->domain }}/">
  {{ $model->domain }}
  @svg (external-link)
</a>
<a class="list-group-item {{ $view == "$tpl.robots" ? 'active' : '' }}" href="{{ path("$self@robots", $model) }}">
  {{ trans("$tpl.robots") }}
</a>
@endsection
