@extends('acp.layout')

@section('model_menu')
@component('tpl.list-group-item', ['href' => path("$self@whois", $model), 'isActive' => $view === "$tpl.whois"])
  {{ trans("$tpl.whois") }}
@endcomponent
@if ($model->yandex_user_id)
  @component('tpl.list-group-item', ['href' => path("$self@mailboxes", $model), 'isActive' => $view === "$tpl.mailboxes"])
    {{ trans("$tpl.mailboxes") }}
  @endcomponent
  @component('tpl.list-group-item', ['href' => path("$self@nsRecords", $model), 'isActive' => $view === "$tpl.ns_records"])
    {{ trans("$tpl.ns_records") }}
  @endcomponent
@endif
@component('tpl.list-group-item', ['href' => "http://{{ $model->domain }}/"])
  {{ $model->domain }}
  @svg (external-link)
@endcomponent
@component('tpl.list-group-item', ['href' => path("$self@robots", $model), 'isActive' => $view === "$tpl.robots"])
  {{ trans("$tpl.robots") }}
@endcomponent
@endsection
