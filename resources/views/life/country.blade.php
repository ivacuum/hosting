@extends('life.base')

@section('content')
<div class="flex flex-wrap gap-2 items-center mb-2">
  <img class="flag-24 svg-shadow" src="{{ $country->flagUrl() }}" alt="">
  <h1 class="font-medium text-3xl tracking-tight mb-1">{{ $country->title }}</h1>
</div>

@include('tpl.trips_by_years')
@endsection
