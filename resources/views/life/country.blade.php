@extends('life.base', [
  'meta_title' => $country->metaTitle(),
  'meta_description' => $country->metaDescription($trips),
])

@section('content')
<div class="d-flex flex-wrap tw-items-center tw-mb-2">
  <img class="flag-24 flag-shadow tw-mr-2" src="{{ $country->flagUrl() }}">
  <h1 class="h2 tw-mb-1">{{ $country->title }}</h1>
</div>

@include('tpl.trips_by_years')
@endsection
