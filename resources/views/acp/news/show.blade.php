@extends('acp.show')

@section('content')
<div>{!! $model->html !!}</div>
<form action="{{ path("$self@notify", $model) }}" method="post">
  <button class="btn btn-default" type="submit">{{ trans("$tpl.notify") }}</button>
  {{ csrf_field() }}
</form>
@parent
@endsection
