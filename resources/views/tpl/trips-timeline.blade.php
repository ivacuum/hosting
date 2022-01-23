<nav class="bg-light dark:bg-slate-800 border dark:border-slate-700 flex flex-wrap flex-col-reverse md:flex-row justify-between text-sm mt-6 p-2 rounded text-center">
  @if (isset($previousTrips) && sizeof($previousTrips))
    @foreach ($previousTrips as $previous)
      <div class="{{ !$loop->first ? 'mb-4 md:mb-0' : '' }}">
        <a class="link" href="{{ $previous->www() }}">{{ $previous->title }}</a>
        <div class="text-xs text-muted dark:text-slate-500">
          {{ $previous->year !== $trip->year ? $previous->localizedDate() : $previous->localizedDateWithoutYear() }}
        </div>
      </div>
    @endforeach
  @endif
  <div class="mb-4 md:mb-0">
    @if (isset($previousTrips) && sizeof($previousTrips))
      <span class="hidden md:inline">&larr;</span>
      <span class="md:hidden">&darr;</span>
    @endif
    <strong>{{ $trip->title }}</strong>
    @if (isset($nextTrips) && sizeof($nextTrips))
      <span class="hidden md:inline">&rarr;</span>
      <span class="md:hidden">&uarr;</span>
    @endif
    <div class="text-xs text-muted dark:text-slate-500">{{ $trip->localizedDate() }}</div>
  </div>
  @if (isset($nextTrips) && sizeof($nextTrips))
    @foreach ($nextTrips as $next)
      <div class="mb-4 md:mb-0">
        <a class="link" href="{{ $next->www() }}">{{ $next->title }}</a>
        <div class="text-xs text-muted dark:text-slate-500">
          {{ $next->year !== $trip->year ? $next->localizedDate() : $next->localizedDateWithoutYear() }}
        </div>
      </div>
    @endforeach
  @endif
</nav>
