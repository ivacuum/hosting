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
    <img class="max-w-full h-auto rounded-sm" src="{{ $model->metaImage() }}" alt="">
  </div>
@endif
@parent
@endsection
