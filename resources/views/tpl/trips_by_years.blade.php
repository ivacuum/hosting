@foreach ($trips as $year => $rows)
  <div class="tw-flex {{ !$loop->first ? 'tw-mt-6' : '' }}">
    <div>
      <div class="travel-year tw-font-bold">{{ $year }}</div>
    </div>
    <div>
    @foreach ($rows as $trip)
      <div class="{{ !$loop->last ? 'tw-mb-2' : '' }}">
        @if ($trip->status === App\Trip::STATUS_PUBLISHED)
          <a class="link tw-mr-1" href="{{ $trip->www() }}">{{ $trip->title }}</a>
        @else
          <span class="tw-mr-1">{{ $trip->title }}</span>
        @endif
        <span class="travel-month tw-mr-2 tw-whitespace-no-wrap">{{ $trip->localizedDateWithoutYear() }}</span>
        @if ($trip->status === App\Trip::STATUS_PUBLISHED && $trip->photos_count)
          <span class="travel-month tw-whitespace-no-wrap">
            @svg (picture-o)
            {{ $trip->photos_count }}
          </span>
        @endif
      </div>
    @endforeach
    </div>
  </div>
@endforeach
