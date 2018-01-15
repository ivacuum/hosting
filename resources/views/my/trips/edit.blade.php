@extends('my.base')

@section('content')
<form action="{{ path("$self@update", $model) }}" method="post">
  @include('my.trips.form')

  <button class="btn btn-primary">{{ trans('acp.save') }}</button>
  <button name="_save" class="btn btn-default">
    {{ trans('acp.apply') }}
  </button>

  {{ method_field('PUT') }}
</form>
@endsection
