@extends('acp.layout')

@section('model_menu')
@component('tpl.list-group-item', ['href' => to('acp/images/{image}/view', $model)])
  @lang("$tpl.view")
@endcomponent
@component('tpl.list-group-item', ['href' => path([App\Http\Controllers\Acp\ImagesController::class, 'index'], ['user_id' => $model->user_id])])
  @lang("$tpl.user")
@endcomponent
@endsection
