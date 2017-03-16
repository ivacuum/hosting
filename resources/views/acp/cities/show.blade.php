@extends('acp.show')

@section('content')
<a class="btn btn-default" href="{{ action("$self@updateGeo", $model) }}">
  {{ trans("$tpl.update_geo") }}
</a>

@parent
@endsection
