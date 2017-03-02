@extends('acp.show')

@section('content')
<div>{!! $model->html !!}</div>
@parent
@endsection
