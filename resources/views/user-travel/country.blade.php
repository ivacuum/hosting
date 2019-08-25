@extends('user-travel.base', [
  'meta_title' => $country->title,
  'meta_description' => $country->metaDescription($trips),
])

@section('content')
<div class="flex flex-wrap items-center mb-2">
  <img class="flag-24 svg-shadow mr-2" src="{{ $country->flagUrl() }}">
  <h1 class="h2 mb-1">{{ $country->title }}</h1>
</div>

@include('tpl.trips_by_years')
@endsection
