@extends('acp.show')

@section('content')
<p><img class="screenshot" src="{{ $model->originalSecretUrl() }}"></p>
@parent
@endsection
