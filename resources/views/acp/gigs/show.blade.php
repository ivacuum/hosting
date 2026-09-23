@extends('acp.show')

@section('content')
@if ($model->meta_image)
  <div class="mt-4">
    <img class="rounded-sm image-fit-viewport" src="{{ $model->meta_image }}" alt="">
  </div>
@endif
@parent
@endsection
