@extends('acp.layout')

@section('model_menu')
@component('tpl.list-group-item', ['href' => path("$self@view", $model)])
  {{ trans("$tpl.view") }}
@endcomponent
@component('tpl.list-group-item', ['href' => path("$self@index", ['user_id' => $model->user_id])])
  {{ trans("$tpl.user") }}
@endcomponent
@endsection
