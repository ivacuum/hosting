@extends('acp.show')

@section('content')
<div>
  <a
    class="btn btn-default"
    href="{{ to('acp/photos/create', [$model->getForeignKey() => $model->id]) }}"
  >Добавить фотографии</a>
</div>
@if ($model->meta_image)
  <div class="mt-4">
    <img class="max-w-full h-auto rounded" src="{{ $model->metaImage() }}" alt="">
  </div>
@endif
<form class="mt-4" action="{{ to('acp/trips/{trip}/notify', $model) }}" method="post">
  @csrf
  <button class="btn btn-default">@lang("$tpl.notify")</button>
</form>
@parent
@endsection
