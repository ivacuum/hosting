@extends('acp.layout')

@section('model_menu')
@if ($model->user_id > 0)
  @component('tpl.list-group-item', ['href' => Acp::show($model->user)])
    @lang("$tpl.user")
    @if ($model->user)
      <div class="text-xs text-muted">{{ $model->user->email }}</div>
    @endif
  @endcomponent
@endif
@endsection
