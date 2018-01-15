@if (sizeof($timeline) > 1)
  <div class="city-timeline f14 mb-3">
    @foreach ($timeline as $year => $rows)
      <ul class="city-timeline-column">
        <li class="font-weight-bold">{{ $year }}</li>
        @foreach ($rows as $row)
          <li class="city-timeline-trip">
            @if ($row->id === $gig->id)
              <mark>{{ $row->shortDate() }}</mark>
            @elseif ($row->status === App\Gig::STATUS_PUBLISHED)
              <a class="link" href="{{ $row->www() }}">{{ $row->shortDate() }}</a>
            @else
              {{ $row->shortDate() }}
            @endif
          </li>
        @endforeach
      </ul>
    @endforeach
  </div>
@endif
