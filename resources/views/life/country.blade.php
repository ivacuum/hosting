@extends('life.base', [
  'meta_title' => $country->title,
])

@section('content')
<h1 class="h2 mt-0">
  <span class="emoji">{{ $country->emoji }}</span>
  {{ $country->title }}
</h1>

@include('tpl.trips_by_years')
@endsection
