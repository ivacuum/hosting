<nav class="travel-timeline-container">
  @if (isset($previous_trips) && sizeof($previous_trips))
    @foreach ($previous_trips as $previous)
      <div class="travel-timeline">
        <div class="travel-timeline-date">
          @if ($previous->year !== $trip->year)
            {{ $previous->localizedDate() }}
          @else
            {{ $previous->localizedDateWithoutYear() }}
          @endif
        </div>
        <a class="link" href="{{ $previous->www() }}">{{ $previous->title }}</a>
      </div>
    @endforeach
  @endif
  <div class="travel-timeline travel-timeline-current">
    <div class="travel-timeline-date">{{ $trip->localizedDate() }}</div>
    <strong>{{ $trip->title }}</strong>
    <div class="travel-timeline-arrows">
      @if (isset($previous_trips) && sizeof($previous_trips))
        <span class="horizontal">&larr;</span>
        <span class="vertical">&darr;</span>
      @endif
      @if (isset($previous_trips) && sizeof($next_trips))
        <span class="horizontal">&rarr;</span>
        <span class="vertical">&uarr;</span>
      @endif
    </div>
  </div>
  @if (isset($next_trips) && sizeof($next_trips))
    @foreach ($next_trips as $next)
      <div class="travel-timeline">
        <div class="travel-timeline-date">
          @if ($next->year !== $trip->year)
            {{ $next->localizedDate() }}
          @else
            {{ $next->localizedDateWithoutYear() }}
          @endif
        </div>
        <a class="link" href="{{ $next->www() }}">{{ $next->title }}</a>
      </div>
    @endforeach
  @endif
</nav>
