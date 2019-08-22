@if (sizeof($timeline) > 1)
  <div class="timeline-container tw-mb-4">
    <div class="timeline-scroll">
      <div class="tw-text-sm tw-flex">
        @foreach ($timeline as $year => $rows)
          <div class="tw-flex tw-flex-col timeline-column">
            <div class="tw-font-bold">{{ $year }}</div>
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
