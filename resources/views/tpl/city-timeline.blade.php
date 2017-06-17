@if (isset($timeline) && sizeof($timeline->flatten()) > 1)
  <div class="city-timeline mb-3">
    @foreach ($timeline as $year => $rows)
      <ul class="city-timeline-column">
        <li class="city-timeline-year">{{ $year }}</li>
        @foreach ($rows as $row)
          <li class="city-timeline-trip">
            @if ($row->id === $trip->id)
              <mark>{{ $row->timelinePeriod() }}</mark>
            @elseif ($row->status === App\Trip::STATUS_PUBLISHED)
              <a class="link" href="{{ $row->www() }}">{{ $row->timelinePeriod() }}</a>
            @else
              {{ $row->timelinePeriod() }}
            @endif
          </li>
        @endforeach
      </ul>
    @endforeach
  </div>
@endif
