@extends('acp.show')

@section('content')
<div class="life-text markdown-body text-break-word">{!! $model->html !!}</div>
<form action="{{ path("$self@notify", $model) }}" method="post">
  <button class="btn btn-default">{{ trans("$tpl.notify") }}</button>
  {{ csrf_field() }}
</form>
@parent
@endsection
