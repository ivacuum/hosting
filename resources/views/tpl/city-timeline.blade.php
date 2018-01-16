@if (isset($timeline) && sizeof($timeline->flatten()) > 1)
  <div class="timeline-container mb-3">
    <div class="timeline-scroll">
      <div class="f14 d-flex">
        @foreach ($timeline as $year => $rows)
          <div class="d-flex flex-column timeline-column">
            <div class="font-weight-bold">{{ $year }}</div>
            @foreach ($rows as $row)
              <div>
                @if ($row->id === $trip->id)
                  <mark>{{ $row->timelinePeriod() }}</mark>
                @elseif ($row->status === App\Trip::STATUS_PUBLISHED)
                  <a class="link" href="{{ $row->www() }}">{{ $row->timelinePeriod() }}</a>
                @else
                  {{ $row->timelinePeriod() }}
                @endif
              </div>
            @endforeach
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endif
