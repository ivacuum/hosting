<nav class="bg-light border d-flex flex-wrap flex-column-reverse flex-md-row justify-content-between f14 mt-4 p-2 rounded text-center">
  @if (isset($previous_trips) && sizeof($previous_trips))
    @foreach ($previous_trips as $previous)
      <div class="{{ !$loop->first ? 'mb-3 mb-md-0' : '' }}">
        <a class="link" href="{{ $previous->www() }}">{{ $previous->title }}</a>
        <div class="f12 text-muted">
          {{ $previous->year !== $trip->year ? $previous->localizedDate() : $previous->localizedDateWithoutYear() }}
        </div>
      </div>
    @endforeach
  @endif
  <div class="mb-3 mb-md-0">
    @if (isset($previous_trips) && sizeof($previous_trips))
      <span class="d-none d-md-inline">&larr;</span>
      <span class="d-md-none">&darr;</span>
    @endif
    <strong>{{ $trip->title }}</strong>
    @if (isset($previous_trips) && sizeof($next_trips))
      <span class="d-none d-md-inline">&rarr;</span>
      <span class="d-md-none">&uarr;</span>
    @endif
    <div class="f12 text-muted">{{ $trip->localizedDate() }}</div>
  </div>
  @if (isset($next_trips) && sizeof($next_trips))
    @foreach ($next_trips as $next)
      <div class="mb-3 mb-md-0">
        <a class="link" href="{{ $next->www() }}">{{ $next->title }}</a>
        <div class="f12 text-muted">
          {{ $next->year !== $trip->year ? $next->localizedDate() : $next->localizedDateWithoutYear() }}
        </div>
      </div>
    @endforeach
  @endif
</nav>
