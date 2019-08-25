<nav class="bg-light border flex flex-wrap flex-col-reverse md:flex-row justify-between text-sm mt-6 p-2 rounded text-center">
  @if (isset($previous_trips) && sizeof($previous_trips))
    @foreach ($previous_trips as $previous)
      <div class="{{ !$loop->first ? 'mb-4 md:mb-0' : '' }}">
        <a class="link" href="{{ $previous->www() }}">{{ $previous->title }}</a>
        <div class="text-xs text-muted">
          {{ $previous->year !== $trip->year ? $previous->localizedDate() : $previous->localizedDateWithoutYear() }}
        </div>
      </div>
    @endforeach
  @endif
  <div class="mb-4 md:mb-0">
    @if (isset($previous_trips) && sizeof($previous_trips))
      <span class="hidden md:inline">&larr;</span>
      <span class="md:hidden">&darr;</span>
    @endif
    <strong>{{ $trip->title }}</strong>
    @if (isset($previous_trips) && sizeof($next_trips))
      <span class="hidden md:inline">&rarr;</span>
      <span class="md:hidden">&uarr;</span>
    @endif
    <div class="text-xs text-muted">{{ $trip->localizedDate() }}</div>
  </div>
  @if (isset($next_trips) && sizeof($next_trips))
    @foreach ($next_trips as $next)
      <div class="mb-4 md:mb-0">
        <a class="link" href="{{ $next->www() }}">{{ $next->title }}</a>
        <div class="text-xs text-muted">
          {{ $next->year !== $trip->year ? $next->localizedDate() : $next->localizedDateWithoutYear() }}
        </div>
      </div>
    @endforeach
  @endif
</nav>
