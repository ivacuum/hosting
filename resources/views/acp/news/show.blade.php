@extends("$tpl.base")

@section('content')
<div>
  {!! $model->html !!}
</div>
@if (Auth::user()->isRoot())
  <pre class="d-inline-block">{{ $model->toJson(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
@endif
@endsection
