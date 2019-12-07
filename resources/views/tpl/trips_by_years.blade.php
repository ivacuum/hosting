<?php
/** @var \App\Trip $trip */
?>

@foreach ($trips as $year => $rows)
  <div class="flex {{ !$loop->first ? 'mt-6' : '' }}">
    <div>
      <div class="sticky top-2 font-bold mr-3">{{ $year }}</div>
    </div>
    <div class="w-full">
    @foreach ($rows as $trip)
      <div class="{{ !$loop->last ? 'mb-2' : '' }}">
        @if ($trip->isPublished())
          <a class="link mr-1" href="{{ $trip->www() }}">{{ $trip->title }}</a>
        @else
          <span class="mr-1">{{ $trip->title }}</span>
        @endif
        <span class="text-xs text-muted mr-2 whitespace-no-wrap">{{ $trip->localizedDateWithoutYear() }}</span>
        @if ($trip->isPublished() && $trip->photos_count)
          <span class="text-xs text-muted whitespace-no-wrap">
            @svg (picture-o)
            {{ $trip->photos_count }}
          </span>
        @endif
      </div>
    @endforeach
    </div>
  </div>
@endforeach
