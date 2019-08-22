@extends('acp.show')

@section('content')
@if ($model->text)
  <div class="tw-whitespace-pre-line">{{ $model->text }}</div>
@endif

@parent
@endsection
