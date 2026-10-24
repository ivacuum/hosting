@extends('acp.layout')

@section('model_menu')
@component('tpl.list-group-item', ['href' => Acp::show($model->user)])
  @lang("$tpl.user")
  <div class="text-xs text-gray-500">{{ $model->user->email }}</div>
@endcomponent
@endsection
