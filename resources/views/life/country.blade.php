@extends('life.base', [
  'meta_title' => $country->metaTitle(),
  'meta_description' => $country->metaDescription($trips),
])

@section('content')
<h1 class="h2">
  {{ $country->emoji }}
  {{ $country->title }}
</h1>

@include('tpl.trips_by_years')
@endsection
