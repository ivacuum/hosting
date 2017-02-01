@if (sizeof($timeline) > 1)
  <div class="city-timeline clearfix">
    @foreach ($timeline as $year => $rows)
      <ul class="city-timeline-column">
        <li class="city-timeline-year">{{ $year }}</li>
        @foreach ($rows as $row)
          <li class="city-timeline-trip">
            @if ($row->id === $gig->id)
              <mark>{{ $row->shortDate() }}</mark>
            @elseif ($row->status === App\Gig::STATUS_PUBLISHED)
              <a class="link" href="{{ action('Life@page', $row->slug) }}">{{ $row->shortDate() }}</a>
            @else
              {{ $row->shortDate() }}
            @endif
          </li>
        @endforeach
      </ul>
    @endforeach
  </div>
@endif
