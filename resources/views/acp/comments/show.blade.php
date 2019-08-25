@extends('acp.show')

@section('content')
<div class="whitespace-pre-line">{!! $model->html !!}</div>
@parent
@endsection
