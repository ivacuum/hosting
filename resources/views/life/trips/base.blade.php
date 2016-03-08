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
  {{--
  @if ($trip->meta_image)
    <div class="cover">
      <div class="cover-image" style="background-image: url({{ $trip->meta_image }});"></div>
      <div class="cover-title">
        <span class="emoji">{{ $trip->city->country->emoji }}</span>
        {{ $trip->title }}
        <div class="cover-description">{{ $trip->getMetaDescription() }}</div>
        <div class="cover-meta">
          {{ $trip->getLocalizedDate() }}
          &nbsp;
          <span class="emoji">{{ $trip->city->country->emoji }}</span>
          {{ $trip->city->country->title }}
        </div>
      </div>
    </div>
  @else
    <h2>
      <span class="emoji">{{ $trip->city->country->emoji }}</span>
      {{ $trip->title }}
    </h2>
  @endif
  --}}
  <div class="trip-text">
@endsection

@section('content_footer')
  </div>
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
    <div class="travel-timeline travel-timeline-current">
      <div class="travel-timeline-date">{{ $trip->period }} {{ $trip->year }}</div>
      <strong>{{ $trip->title }}</strong>
      <div class="travel-timeline-arrows">
        @if (sizeof($previous_trips))
          <span class="horizontal">&larr;</span>
          <span class="vertical">&darr;</span>
        @endif
        @if (sizeof($next_trips))
          <span class="horizontal">&rarr;</span>
          <span class="vertical">&uarr;</span>
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
