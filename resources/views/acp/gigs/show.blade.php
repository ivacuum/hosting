@extends("$tpl.base")

@section('content')
@if ($model->meta_image)
  <div>
    <img class="img-responsive img-rounded" src="{{ $model->meta_image }}">
  </div>
@endif
@if (Auth::user()->isRoot())
  <pre class="json-model">{{ $model->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
@endif
@endsection
