@extends('acp.layout')

@section('model_menu')
<a class="list-group-item" href="{{ action('Acp\Users@show', $model->user_id) }}">
  {{ trans("$tpl.user") }}
</a>
<a class="list-group-item" href="{{ action("$self@updateRto", $model) }}">
  {{ trans("$tpl.update_rto") }}
</a>
@endsection
