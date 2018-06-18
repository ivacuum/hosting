@foreach ($trips as $year => $rows)
  <div class="d-flex {{ !$loop->first ? 'mt-4' : '' }}">
    <div>
      <div class="font-weight-bold travel-year">{{ $year }}</div>
    </div>
    <div>
    @foreach ($rows as $trip)
      <div class="{{ !$loop->last ? 'mb-2' : '' }}">
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
    @endforeach
    </div>
  </div>
@endforeach
