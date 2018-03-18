@extends('acp.show')

@section('content')
@if ($model->text)
  <div class="pre-line">{{ $model->text }}</div>
@endif

@parent
@endsection
