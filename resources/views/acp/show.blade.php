@extends("$tpl.base")

@section('content')
@if (Auth::user()->isRoot())
  <div class="mt-3">
    <pre class="json-model">{{ $model->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
  </div>
@endif
@endsection
