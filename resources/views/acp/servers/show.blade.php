@extends("$tpl.base")

@section('content')
@if ($model->text)
  <div>{!! nl2br($model->text) !!}</div>
@endif
@endsection
