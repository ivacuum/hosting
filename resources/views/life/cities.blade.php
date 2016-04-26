@extends('life.base', [
  'meta_title' => 'Города',
])

@section('content')
  <h2>Посещенные города</h2>
  <ul class="list-inline trips-show-by">
    <li><a class="link" href="/life">по годам</a></li>
    <li><a class="link" href="/life/countries">по странам</a></li>
    <li><mark>по городам</mark></li>
  </ul>
  <div class="row">
    <div class="col-sm-3">
      <?php $initial = $current_initial = false; ?>
      @foreach ($cities as $city)
        <?php $current_initial = $city->getInitial(); ?>
        <?php $trips = $city->getTripsCount(); ?>
        <div class="city-entry">
          @if ($initial !== $current_initial)
            <span class="city-initial">{{ $current_initial }}</span>
          @endif
          <a class="link" href="/life/{{ $city->slug }}">{{ $city->title }}</a>
          @if ($trips > 1)
            <span class="city-trips">{{ $trips }}</span>
          @endif
        </div>
        <?php $initial = $current_initial; ?>
      @endforeach
    </div>
  </div>
@endsection
