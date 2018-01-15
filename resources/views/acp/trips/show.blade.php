@extends('acp.show')

@section('content')
<div>
  <a class="btn btn-default" href="{{ path('Acp\Photos@create', [$model->getForeignKey() => $model->id]) }}">Добавить фотографии</a>
</div>
@if ($model->meta_image)
  <div class="mt-3">
    <img class="img-fluid rounded" src="{{ $model->metaImage() }}">
  </div>
@endif
<form class="mt-3" action="{{ path("$self@notify", $model) }}" method="post">
  <button class="btn btn-default">{{ trans("$tpl.notify") }}</button>
  {{ csrf_field() }}
</form>
@parent
@endsection
