@extends('acp.layout')

@section('model_menu')
@component('tpl.list-group-item', ['href' => path([$controller, 'view'], $model)])
  @lang("$tpl.view")
@endcomponent
@component('tpl.list-group-item', ['href' => path([$controller, 'index'], ['user_id' => $model->user_id])])
  @lang("$tpl.user")
@endcomponent
@endsection
