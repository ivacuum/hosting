@extends('acp.show')

@section('content')
@if ($model->meta_image)
  <div>
    <img class="img-fluid rounded image-fit-viewport" src="{{ $model->meta_image }}">
  </div>
@endif
@parent
@endsection
