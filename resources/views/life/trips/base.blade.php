@extends('life.base', [
  'meta_title' => $trip->getMetaTitle(),
  'meta_description' => $trip->getMetaDescription(),
  'meta_image' => $trip->meta_image,
])

@section('content_header')
@parent
<h2>
  <span class="emoji">{{ $trip->city->country->emoji }}</span>
  {{ $trip->title }}
</h2>
@endsection

@section('content_footer')
  <div class="travel-timeline-container">
    @if (sizeof($previous_trips))
      @foreach ($previous_trips as $previous)
        <div class="travel-timeline">
          <div class="travel-timeline-date">
            {{ $previous->period }}
            @if ($previous->year !== $trip->year)
              {{ $previous->year }}
            @endif
          </div>
          <a class="link" href="/life/{{ $previous->slug }}">{{ $previous->title }}</a>
        </div>
      @endforeach
    @endif
    <div class="travel-timeline">
      <div class="travel-timeline-date">{{ $trip->period }} {{ $trip->year }}</div>
      <strong>{{ $trip->title }}</strong>
      <div>
        @if (sizeof($previous_trips))
          &larr;
        @endif
        @if (sizeof($next_trips))
          &rarr;
        @endif
      </div>
    </div>
    @if (sizeof($next_trips))
      @foreach ($next_trips as $next)
        <div class="travel-timeline">
          <div class="travel-timeline-date">
            {{ $next->period }}
            @if ($next->year !== $trip->year)
              {{ $next->year }}
            @endif
          </div>
          <a class="link" href="/life/{{ $next->slug }}">{{ $next->title }}</a>
        </div>
      @endforeach
    @endif
  </div>
  @parent
@endsection
