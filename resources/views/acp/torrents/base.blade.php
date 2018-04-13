@extends('acp.layout')

@section('model_menu')
<a class="list-group-item list-group-item-action" href="{{ path('Acp\Users@show', $model->user_id) }}">
  {{ trans("$tpl.user") }}
  @if (null !== $model->user)
    <div class="small text-muted">{{ $model->user->email }}</div>
  @endif
</a>
<a class="list-group-item list-group-item-action" href="{{ path("$self@updateRto", $model) }}">
  {{ trans("$tpl.update_rto") }}
</a>
@endsection
