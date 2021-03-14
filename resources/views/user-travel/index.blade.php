@extends('user-travel.base')

@section('content')
<section class="pt-0">
  <div class="flex flex-wrap items-center">
    <h1 class="h2 mr-4">
      @lang('Поездки')
    </h1>
    @if ($traveler->id == Auth::user()?->id)
      <a class="btn btn-success text-sm py-1" href="@lng/my/trips/create">
        @lang('acp.trips.create')
      </a>
    @endif
  </div>
  <x-user-trips-subnav/>

  @include('tpl.trips_by_years')
</section>
@endsection
