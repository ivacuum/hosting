@extends('acp.show')

@section('content')
@if ($model->meta_image)
  <div>
    <img class="img-responsive img-rounded" src="{{ $model->metaImage() }}">
  </div>
@endif
@parent
@endsection
