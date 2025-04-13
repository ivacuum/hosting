@extends('acp.layout')

@section('model_menu')
@component('tpl.list-group-item', ['href' => Acp::show(new App\User, $model->user_id)])
  @lang("$tpl.user")
  @if ($model->user)
    <div class="text-xs text-gray-500">{{ $model->user->email }}</div>
  @endif
@endcomponent
@endsection
