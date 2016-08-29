@if (sizeof($timeline) > 1)
  <div class="city-timeline clearfix">
    @php ($year = false)
    @foreach ($timeline as $row)
      @if ($year !== $row->date->year)
        {!! !$loop->first ? '</ul>' : '' !!}
        <ul class="city-timeline-column">
          <li class="city-timeline-year">{{ $row->date->year }}</li>
          @endif
          <li class="city-timeline-trip">
            @if ($row->id === $gig->id)
              <mark>{{ $row->shortDate() }}</mark>
            @elseif ($gig->status === App\Gig::STATUS_PUBLISHED)
              <a class="link" href="{{ action('Life@page', $row->slug) }}">{{ $row->shortDate() }}</a>
            @else
              {{ $row->shortDate() }}
            @endif
          </li>
          @if ($loop->last)
        </ul>
      @endif
      @php ($year = $row->date->year)
    @endforeach
  </div>
@endif
