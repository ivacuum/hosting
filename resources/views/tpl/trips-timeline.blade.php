<nav class="bg-slate-50 dark:bg-slate-800 border border-gray-200 dark:border-slate-700 flex flex-wrap flex-col-reverse md:flex-row justify-between text-sm mt-6 p-2 rounded-sm">
  @if (isset($previousTrips) && count($previousTrips))
    @foreach ($previousTrips as $previous)
      <div class="{{ !$loop->first ? 'mb-4 md:mb-0' : '' }}">
        <a class="link" href="{{ $previous->www() }}">{{ $previous->title }}</a>
        <div class="text-xs text-gray-500 dark:text-slate-500">
          {{ $previous->year !== $trip->year ? $previous->localizedDate() : $previous->localizedDateWithoutYear() }}
        </div>
      </div>
    @endforeach
  @endif
  <div class="mb-4 md:mb-0">
    @if (isset($previousTrips) && count($previousTrips))
      <span class="hidden md:inline">&larr;</span>
      <span class="md:hidden">&darr;</span>
    @endif
    <strong>{{ $trip->title }}</strong>
    @if (isset($nextTrips) && count($nextTrips))
      <span class="hidden md:inline">&rarr;</span>
      <span class="md:hidden">&uarr;</span>
    @endif
    <div class="text-xs text-gray-500 dark:text-slate-500">{{ $trip->localizedDate() }}</div>
  </div>
  @if (isset($nextTrips) && count($nextTrips))
    @foreach ($nextTrips as $next)
      <div class="mb-4 md:mb-0">
        <a class="link" href="{{ $next->www() }}">{{ $next->title }}</a>
        <div class="text-xs text-gray-500 dark:text-slate-500">
          {{ $next->year !== $trip->year ? $next->localizedDate() : $next->localizedDateWithoutYear() }}
        </div>
      </div>
    @endforeach
  @endif
</nav>
