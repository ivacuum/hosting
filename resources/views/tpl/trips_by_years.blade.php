@php ($year = false)
@foreach ($trips as $trip)
  <div class="travel-entry mb-2">
    @if ($year !== $trip->year)
      <span class="travel-year">{{ $trip->year }}</span>
    @endif
    @if ($trip->status === App\Trip::STATUS_PUBLISHED)
      <a class="link" href="{{ action('Life@page', $trip->slug) }}">{{ $trip->title }}</a>
    @else
      {{ $trip->title }}
    @endif
    <span class="travel-month">{{ $trip->period }}</span>
  </div>
  @php ($year = $trip->year)
@endforeach
