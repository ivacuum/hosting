@extends('acp.show')

@section('content')
<div class="hanging-punctuation-first lg:text-lg markdown-body break-words">{!! $model->html !!}</div>
<form action="{{ path([App\Http\Controllers\Acp\NewsController::class, 'notify'], $model) }}" method="post">
  @csrf
  <button class="btn btn-default">@lang("$tpl.notify")</button>
</form>
@parent
@endsection
