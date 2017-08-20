@php ($year = false)
@foreach ($trips as $trip)
  <div class="travel-entry mb-2 {{ $year !== false && $year !== $trip->year ? 'mt-4' : '' }}">
    @if ($year !== $trip->year)
      <span class="travel-year">{{ $trip->year }}</span>
    @endif
    @if ($trip->status === App\Trip::STATUS_PUBLISHED)
      <a class="link mr-1" href="{{ $trip->www() }}">{{ $trip->title }}</a>
    @else
      <span class="mr-1">{{ $trip->title }}</span>
    @endif
    <span class="travel-month mr-2 text-nowrap">{{ $trip->localizedDateWithoutYear() }}</span>
    @if ($trip->status === App\Trip::STATUS_PUBLISHED && $trip->photos_count)
      <span class="travel-month text-nowrap">
        @svg (picture-o)
        {{ $trip->photos_count }}
      </span>
    @endif
  </div>
  @php ($year = $trip->year)
@endforeach
