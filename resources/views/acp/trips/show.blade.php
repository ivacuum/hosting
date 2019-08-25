@extends('acp.show')

@section('content')
<div>
  <a class="btn btn-default" href="{{ path('Acp\Photos@create', [$model->getForeignKey() => $model->id]) }}">Добавить фотографии</a>
</div>
@if ($model->meta_image)
  <div class="mt-4">
    <img class="max-w-full h-auto rounded" src="{{ $model->metaImage() }}">
  </div>
@endif
<form class="mt-4" action="{{ path("$self@notify", $model) }}" method="post">
  @csrf
  <button class="btn btn-default">{{ trans("$tpl.notify") }}</button>
</form>
@parent
@endsection
