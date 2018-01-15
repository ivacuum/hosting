<nav class="d-flex flex-wrap flex-column-reverse flex-md-row justify-content-between f14 mt-4 text-center">
  @if (isset($previous_trips) && sizeof($previous_trips))
    @foreach ($previous_trips as $previous)
      <div class="mb-3 mb-md-0">
        <div class="f12 text-muted">
          {{ $previous->year !== $trip->year ? $previous->localizedDate() : $previous->localizedDateWithoutYear() }}
        </div>
        <a class="link" href="{{ $previous->www() }}">{{ $previous->title }}</a>
      </div>
    @endforeach
  @endif
  <div class="mb-3 mb-md-0">
    <div class="f12 text-muted">{{ $trip->localizedDate() }}</div>
    <strong>{{ $trip->title }}</strong>
    <div>
      @if (isset($previous_trips) && sizeof($previous_trips))
        <span class="d-none d-md-inline">&larr;</span>
        <span class="d-md-none">&darr;</span>
      @endif
      @if (isset($previous_trips) && sizeof($next_trips))
        <span class="d-none d-md-inline">&rarr;</span>
        <span class="d-md-none">&uarr;</span>
      @endif
    </div>
  </div>
  @if (isset($next_trips) && sizeof($next_trips))
    @foreach ($next_trips as $next)
      <div class="mb-3 mb-md-0">
        <div class="f12 text-muted">
          {{ $next->year !== $trip->year ? $next->localizedDate() : $next->localizedDateWithoutYear() }}
        </div>
        <a class="link" href="{{ $next->www() }}">{{ $next->title }}</a>
      </div>
    @endforeach
  @endif
</nav>
