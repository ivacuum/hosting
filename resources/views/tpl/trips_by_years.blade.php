@php ($year = false)
@foreach ($trips as $trip)
  <div class="travel-entry mb-2 {{ $year !== false && $year !== $trip->year ? 'mt-4' : '' }}">
    @if ($year !== $trip->year)
      <span class="travel-year">{{ $trip->year }}</span>
    @endif
    @if ($trip->status === App\Trip::STATUS_PUBLISHED)
      <a class="link" href="{{ $trip->www() }}">{{ $trip->title }}</a>
    @else
      {{ $trip->title }}
    @endif
    <span class="travel-month ml-1 mr-2">{{ $trip->period }}</span>
    @if ($trip->photos_count)
      <span class="travel-month text-nowrap">
        @svg (picture-o)
        {{ $trip->photos_count }}
      </span>
    @endif
  </div>
  @php ($year = $trip->year)
@endforeach
