@extends('acp.show')

@section('content')
<div>
  {!! nl2br($model->html) !!}
</div>
@parent
@endsection
