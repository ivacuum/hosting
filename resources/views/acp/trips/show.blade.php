@extends('acp.show')

@section('content')
<form action="{{ action("$self@notify", $model) }}" method="post">
  <button class="btn btn-default" type="submit">{{ trans("$tpl.notify") }}</button>
  {{ csrf_field() }}
</form>
<div class="mt-3">
  <a class="link" href="{{ action('Acp\Photos@create', [$model->getForeignKey() => $model->id]) }}">Добавить фотографии</a>
</div>
@if ($model->meta_image)
  <div>
    <img class="img-responsive img-rounded" src="{{ $model->metaImage() }}">
  </div>
@endif
@parent
@endsection
