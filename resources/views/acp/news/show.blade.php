@extends('acp.show')

@section('content')
<div class="hanging-punctuation-first lg:text-lg markdown-body break-words">{!! $model->html !!}</div>
@parent
@endsection
