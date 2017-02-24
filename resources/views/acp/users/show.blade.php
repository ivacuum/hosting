@extends("$tpl.base")

@section('content')
<div>
  @include('tpl.avatar', ['user' => $model])
</div>
@if (Auth::user()->isRoot())
  <pre class="json-model">{{ $model->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
@endif
@endsection
