@extends('acp.show')

@section('content')
<div>
  @include('tpl.avatar', ['user' => $model, 'classes' => 'w-24 h-24'])
</div>
@parent
@endsection
