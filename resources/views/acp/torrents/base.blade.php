@extends('acp.layout')

@section('model_menu')
@component('tpl.list-group-item', ['href' => path('Acp\Users@show', $model->user_id)])
  {{ trans("$tpl.user") }}
  @if (null !== $model->user)
    <div class="text-xs text-muted">{{ $model->user->email }}</div>
  @endif
@endcomponent
@component('tpl.list-group-item', ['href' => path("$self@updateRto", $model)])
  {{ trans("$tpl.update_rto") }}
@endcomponent
@endsection
