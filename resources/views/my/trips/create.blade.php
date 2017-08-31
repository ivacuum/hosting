@extends('my.base')

@section('content')
<h3 class="mt-2 mb-4">{{ trans('acp.trips.create') }}</h3>

<form action="{{ path("$self@store") }}" method="post" class="form-horizontal">

  @include('my.trips.form')

  <div class="form-group">
    <div class="col-xs-12">
      <button class="btn btn-primary">{{ trans('acp.trips.add') }}</button>
    </div>
  </div>

</form>
@endsection
