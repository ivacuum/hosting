@extends("$tpl.base")

@section('content')
<p><img class="gallery-photo" src="{{ $model->originalSecretUrl() }}"></p>
@if (Auth::user()->isRoot())
  <pre class="d-inline-block">{{ $model->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
@endif
@endsection
