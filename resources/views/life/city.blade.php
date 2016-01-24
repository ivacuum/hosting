@extends('life.base', [
  'meta_title' => $city->title,
])

@section('content')
  <div class="row">
    <div class="col-sm-6">
      <h2>
        <span class="emoji">{{ $city->country->emoji }}</span>
        {{ $city->title }}
      </h2>
      @include('tpl.trips_by_years', ['trips' => $city->trips])
    </div>
    <div class="col-sm-6">
      @if ($city->iata)
        @include('tpl.tickets_calendar', ['origin' => 'MOW', 'destination' => $city->iata])
      @endif
    </div>
  </div>
@endsection
