@if (sizeof($timeline) > 1)
  <div class="timeline-container mb-3">
    <div class="timeline-scroll">
      <div class="f14 d-flex">
        @foreach ($timeline as $year => $rows)
          <div class="d-flex flex-column timeline-column">
            <div class="font-weight-bold">{{ $year }}</div>
            @foreach ($rows as $row)
              <div>
                @if ($row->id === $gig->id)
                  <mark>{{ $row->shortDate() }}</mark>
                @elseif ($row->status === App\Gig::STATUS_PUBLISHED)
                  <a class="link" href="{{ $row->www() }}">{{ $row->shortDate() }}</a>
                @else
                  {{ $row->shortDate() }}
                @endif
              </div>
            @endforeach
          </div>
        @endforeach
      </div>
    </div>
  </div>
@endif
