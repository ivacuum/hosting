@extends('acp.show')

@section('content')
<div>
  <a class="btn btn-default" href="{{ path('Acp\Photos@create', [$model->getForeignKey() => $model->id]) }}">Добавить фотографии</a>
</div>
@if ($model->meta_image)
  <div class="tw-mt-4">
    <img class="tw-max-w-full tw-h-auto tw-rounded" src="{{ $model->metaImage() }}">
  </div>
@endif
<form class="tw-mt-4" action="{{ path("$self@notify", $model) }}" method="post">
  @csrf
  <button class="btn btn-default">{{ trans("$tpl.notify") }}</button>
</form>
@parent
@endsection
