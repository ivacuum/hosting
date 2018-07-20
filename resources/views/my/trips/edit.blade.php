@extends('my.base')

@section('content')
<form action="{{ path("$self@update", $model) }}" method="post">
  @method('put')
  @include('my.trips.form')

  <button class="btn btn-primary">{{ trans('acp.save') }}</button>
  <button name="_save" class="btn btn-default">
    {{ trans('acp.apply') }}
  </button>
</form>
@endsection
