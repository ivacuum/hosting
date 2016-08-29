@if (sizeof($timeline) > 1)
  <div class="city-timeline clearfix">
    @php ($year = false)
    @foreach ($timeline as $row)
      @if ($year !== $row->year)
        {!! !$loop->first ? '</ul>' : '' !!}
        <ul class="city-timeline-column">
          <li class="city-timeline-year">{{ $row->year }}</li>
          @endif
          <li class="city-timeline-trip">
            @if ($row->id === $trip->id)
              <mark>{{ $row->period }}</mark>
            @elseif ($row->published)
              <a class="link" href="{{ action('Life@page', $row->slug) }}">{{ $row->period }}</a>
            @else
              {{ $row->period }}
            @endif
          </li>
          @if ($loop->last)
        </ul>
      @endif
      @php ($year = $row->year)
    @endforeach
  </div>
@endif
