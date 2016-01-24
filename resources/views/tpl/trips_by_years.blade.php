<?php $year = false; ?>
@foreach ($trips as $trip)
  <div class="travel-entry">
    @if ($year !== $trip->year)
      <span class="travel-year">{{ $trip->year }}</span>
    @endif
    @if ($trip->published)
      <a class="link" href="/life/{{ $trip->slug }}">{{ $trip->title }}</a>
    @else
      {{ $trip->title }}
    @endif
    <span class="travel-month">{{ $trip->period }}</span>
  </div>
  <?php $year = $trip->year; ?>
@endforeach
