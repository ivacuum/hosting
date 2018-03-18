@extends('acp.show')

@section('content')
<div class="pre-line">{!! $model->html !!}</div>
@parent
@endsection
