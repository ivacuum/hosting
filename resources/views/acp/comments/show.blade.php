@extends('acp.show')

@section('content')
<div class="tw-whitespace-pre-line">{!! $model->html !!}</div>
@parent
@endsection
