@extends('acp.show')

@section('content')
<div><img class="screenshot" src="{{ $model->originalSecretUrl() }}"></div>
@parent
@endsection
