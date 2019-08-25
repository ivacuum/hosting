@extends('acp.show')

@section('content')
@if ($model->text)
  <div class="whitespace-pre-line">{{ $model->text }}</div>
@endif

@parent
@endsection
