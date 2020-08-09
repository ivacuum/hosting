@extends('my.base')

@section('content')
<form action="{{ path([App\Http\Controllers\MyTrips::class, 'update'], $model) }}" method="post">
  @method('put')
  @include('my.trips.form')

  <button class="btn btn-primary">@lang('acp.save')</button>
  <button name="_save" class="btn btn-default">
    @lang('acp.apply')
  </button>
</form>
@endsection
