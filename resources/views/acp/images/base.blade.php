@extends('acp.layout')

@section('model_menu')
<a class="list-group-item" href="{{ action("$self@view", $model) }}">
  {{ trans("$tpl.view") }}
</a>
<a class="list-group-item" href="{{ action("$self@index", ['user_id' => $model->user_id]) }}">
  {{ trans("$tpl.user") }}
</a>
@endsection
