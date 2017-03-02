@extends('acp.show')

@section('content')
<div>
  @include('tpl.avatar', ['user' => $model])
</div>
@parent
@endsection
