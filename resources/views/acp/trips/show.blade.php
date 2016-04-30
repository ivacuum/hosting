@extends('acp.trips.base')

@section('content')
@if ($trip->meta_image)
  <div>
    <img class="img-responsive img-rounded" src="{{ $trip->meta_image }}">
  </div>
@endif
@endsection
