@extends('my.base')

@section('content')
<h3>{{ trans('acp.trips.create') }}</h3>

<form action="{{ path([App\Http\Controllers\MyTrips::class, 'store']) }}" method="post">

  @include('my.trips.form')

  <button class="btn btn-primary">{{ trans('acp.trips.add') }}</button>

</form>
@endsection
