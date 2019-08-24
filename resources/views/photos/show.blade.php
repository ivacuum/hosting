@extends('photos.base')

@push('js')
<script>
Mousetrap.bind('left', () => {
  $(document).trigger('shortcuts.to_prev_page')
})

Mousetrap.bind('right', () => {
  $(document).trigger('shortcuts.to_next_page')
})
</script>
@endpush

@section('content')
<div class="lg:tw-flex lg:tw--mx-4 tw--mt-2">
  <div class="lg:tw-w-5/6 lg:tw-px-4 tw-mb-4">
    <div class="tw-mobile-wide tw-relative tw-text-center">
      @if (null !== $next)
        <a class="photo-show-nav photo-show-prev js-pjax js-pjax-no-dim" id="prev_page" href="{{ path("$self@show", [$next->id, 'city_id' => $city_id, 'country_id' => $country_id, 'tag_id' => $tag_id, 'trip_id' => $trip_id]) }}">&nbsp;</a>
      @endif
      @if (null !== $prev)
        <a class="photo-show-nav photo-show-next js-pjax js-pjax-no-dim" id="next_page" href="{{ path("$self@show", [$prev->id, 'city_id' => $city_id, 'country_id' => $country_id, 'tag_id' => $tag_id, 'trip_id' => $trip_id]) }}">&nbsp;</a>
      @endif
      <div class="tw-inline-block tw-relative">
        @if (null !== $next)
          <div class="photo-overlay-arrow tw-left-0 tw-pl-1">
            @svg (chevron-left)
          </div>
        @endif
        @if (null !== $prev)
          <div class="photo-overlay-arrow tw-right-0 tw-pr-1">
            @svg (chevron-right)
          </div>
        @endif
        <img class="photo-show-img" src="{{ $photo->originalUrl() }}">
      </div>
    </div>
  </div>
  <div class="lg:tw-w-1/6 lg:tw-px-4">
    <div class="tw-flex tw-flex-wrap md:tw-flex-col">
      <div class="tw-mr-2 md:tw-mr-0 text-muted">{{ trans('photos.story') }}</div>
      <a class="tw-flex tw-flex-wrap tw-items-center link-parent" href="{{ $photo->rel->www() }}#{{ basename($photo->slug) }}">
        <img class="flag-16 flag-shadow tw-mr-1" src="{{ $photo->rel->city->country->flagUrl() }}">
        <span class="link">{{ $photo->rel->title }}</span>
      </a>
    </div>

    <div class="tw-flex tw-flex-wrap md:tw-flex-col tw-mt-1 md:tw-mt-4">
      <div class="tw-mr-2 md:tw-mr-0 text-muted">{{ trans('photos.date') }}</div>
      <div>{{ $photo->rel->period }} {{ $photo->rel->year }}</div>
    </div>

    <div class="tw-mt-4">
      <div class="text-muted">
        {{ trans('photos.geotags') }}
        @if ($photo->isOnMap())
          <a href="{{ path('Photos@map', ['lat' => $photo->lat, 'lon' => $photo->lon, 'zoom' => 16]) }}">@svg (map-marker)</a>
        @endif
      </div>
      <div><a class="link" href="{{ path('Photos@city', $photo->rel->city->slug) }}">#{{ mb_strtolower($photo->rel->city->title) }}</a></div>
      <div><a class="link" href="{{ path('Photos@country', $photo->rel->city->country->slug) }}">#{{ mb_strtolower($photo->rel->city->country->title) }}</a></div>
    </div>

    @if (sizeof($photo->tags))
      <div class="tw-mt-4">
        <div class="text-muted">{{ trans('photos.tags') }}</div>
        @foreach ($photo->tags as $tag)
          <div>
            <a class="link" href="{{ path('Photos@tag', $tag) }}">#{{ $tag->title }}</a>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</div>
@if (null !== $prev)
  <img hidden src="{{ $prev->originalUrl() }}">
@endif
@if (null !== $next)
  <img hidden src="{{ $next->originalUrl() }}">
@endif
@endsection
