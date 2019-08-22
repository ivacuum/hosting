@extends('acp.show')

@section('content')
<div class="life-text markdown-body tw-break-words">{!! $model->html !!}</div>
<form action="{{ path("$self@notify", $model) }}" method="post">
  @csrf
  <button class="btn btn-default">{{ trans("$tpl.notify") }}</button>
</form>
@parent
@endsection
