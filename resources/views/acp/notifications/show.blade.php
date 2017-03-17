@extends('acp.show')

@section('content')
<pre class="json-model">{{ json_encode(json_decode($model->data), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
@parent
@endsection
