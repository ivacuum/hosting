<nav class="bg-light border tw-flex tw-flex-wrap tw-flex-col-reverse md:tw-flex-row tw-justify-between tw-text-sm tw-mt-6 tw-p-2 tw-rounded tw-text-center">
  @if (isset($previous_trips) && sizeof($previous_trips))
    @foreach ($previous_trips as $previous)
      <div class="{{ !$loop->first ? 'tw-mb-4 md:tw-mb-0' : '' }}">
        <a class="link" href="{{ $previous->www() }}">{{ $previous->title }}</a>
        <div class="tw-text-xs text-muted">
          {{ $previous->year !== $trip->year ? $previous->localizedDate() : $previous->localizedDateWithoutYear() }}
        </div>
      </div>
    @endforeach
  @endif
  <div class="tw-mb-4 md:tw-mb-0">
    @if (isset($previous_trips) && sizeof($previous_trips))
      <span class="tw-hidden md:tw-inline">&larr;</span>
      <span class="md:tw-hidden">&darr;</span>
    @endif
    <strong>{{ $trip->title }}</strong>
    @if (isset($previous_trips) && sizeof($next_trips))
      <span class="tw-hidden md:tw-inline">&rarr;</span>
      <span class="md:tw-hidden">&uarr;</span>
    @endif
    <div class="tw-text-xs text-muted">{{ $trip->localizedDate() }}</div>
  </div>
  @if (isset($next_trips) && sizeof($next_trips))
    @foreach ($next_trips as $next)
      <div class="tw-mb-4 md:tw-mb-0">
        <a class="link" href="{{ $next->www() }}">{{ $next->title }}</a>
        <div class="tw-text-xs text-muted">
          {{ $next->year !== $trip->year ? $next->localizedDate() : $next->localizedDateWithoutYear() }}
        </div>
      </div>
    @endforeach
  @endif
</nav>
