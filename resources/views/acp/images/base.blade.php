@extends('acp.layout')

@section('model_menu')
@component('tpl.list-group-item', ['href' => path([App\Http\Controllers\Acp\Images::class, 'view'], $model)])
  @lang("$tpl.view")
@endcomponent
@component('tpl.list-group-item', ['href' => path([App\Http\Controllers\Acp\Images::class, 'index'], ['user_id' => $model->user_id])])
  @lang("$tpl.user")
@endcomponent
@endsection
