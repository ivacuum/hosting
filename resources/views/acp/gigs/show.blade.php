@extends('acp.gigs.base')

@section('content')
@if ($gig->meta_image)
  <div>
    <img class="img-responsive img-rounded" src="{{ $gig->meta_image }}">
  </div>
@endif
@endsection
