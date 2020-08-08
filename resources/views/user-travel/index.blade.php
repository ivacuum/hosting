@extends('user-travel.base', [
  'metaTitle' => __('Заметки'),
])

@section('content')
<section class="pt-0">
  <div class="flex flex-wrap items-center">
    <h1 class="h2 mr-4">
      @lang('Поездки')
    </h1>
    @if ($traveler->id == optional(auth()->user())->id)
      <a class="btn btn-success text-sm py-1" href="{{ path([App\Http\Controllers\MyTrips::class, 'create']) }}">
        {{ trans('acp.trips.create') }}
      </a>
    @endif
  </div>
  <x-user-trips-subnav/>

  @include('tpl.trips_by_years')
</section>
@endsection
