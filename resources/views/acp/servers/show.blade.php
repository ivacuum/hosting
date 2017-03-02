@extends('acp.show')

@section('content')
@if ($model->text)
  <div>{!! nl2br($model->text) !!}</div>
@endif
@parent
@endsection
