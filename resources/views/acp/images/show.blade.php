@extends("$tpl.base")

@section('content')
<p><img class="screenshot" src="{{ $model->originalSecretUrl() }}"></p>
@if (Auth::user()->isRoot())
  <pre class="json-model">{{ $model->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
@endif
@endsection
