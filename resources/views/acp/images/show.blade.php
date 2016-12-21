@extends("$tpl.base")

@section('content')
<p>
  <a href="?type=public">
    <img class="gallery-photo" src="{{ Request::input('type') == 'public' ? $model->originalUrl() : $model->originalSecretUrl() }}">
  </a>
</p>
@if (Auth::user()->isRoot())
  <pre class="d-inline-block">{{ $model->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
@endif
@endsection
