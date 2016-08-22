@extends("$tpl.base")

@section('content')
@if ($model->meta_image)
  <div>
    <img class="img-responsive img-rounded" src="{{ $model->meta_image }}">
  </div>
@endif
@endsection
