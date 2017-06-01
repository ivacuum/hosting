@extends('acp.show')

@section('content')
<form action="{{ path("$self@notify", $model) }}" method="post">
  <button class="btn btn-default" type="submit">{{ trans("$tpl.notify") }}</button>
  {{ csrf_field() }}
</form>
<div class="mt-3">
  <a href="{{ path('Acp\Photos@create', [$model->getForeignKey() => $model->id]) }}">Добавить фотографии</a>
</div>
@if ($model->meta_image)
  <div class="mt-3">
    <img class="img-responsive img-rounded" src="{{ $model->metaImage() }}">
  </div>
@endif
@parent
@endsection
