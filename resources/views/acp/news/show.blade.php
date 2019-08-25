@extends('acp.show')

@section('content')
<div class="tw-antialiased hanging-puntuation-first lg:tw-text-lg markdown-body tw-break-words">{!! $model->html !!}</div>
<form action="{{ path("$self@notify", $model) }}" method="post">
  @csrf
  <button class="btn btn-default">{{ trans("$tpl.notify") }}</button>
</form>
@parent
@endsection
