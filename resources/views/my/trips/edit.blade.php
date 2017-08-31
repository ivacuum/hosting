@extends('my.base')

@section('content')
<h3 class="mt-2 mb-4">{{ trans('acp.trips.edit') }}</h3>

<form action="{{ path("$self@update", $model) }}" method="post" class="form-horizontal">

  @include('my.trips.form')

  <div class="form-group">
    <div class="col-xs-12">
      <button class="btn btn-primary">{{ trans('acp.save') }}</button>
      <button name="_save" class="btn btn-default">
        {{ trans('acp.apply') }}
      </button>
    </div>
  </div>

  {{ method_field('PUT') }}

</form>
@endsection
