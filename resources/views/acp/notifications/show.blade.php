@extends('acp.show')

@section('content')
<div class="bg-light border mt-4 py-1 px-2">
  <pre class="inline-block break-words mb-0 max-w-full">{{ json_encode($model->data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
</div>
@parent
@endsection
