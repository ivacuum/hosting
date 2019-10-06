@extends('acp.show')

@section('content')
<div class="antialiased hanging-puntuation-first lg:text-lg markdown-body break-words">{!! $model->html !!}</div>
<form action="{{ path([$controller, 'notify'], $model) }}" method="post">
  @csrf
  <button class="btn btn-default">{{ trans("$tpl.notify") }}</button>
</form>
@parent
@endsection
