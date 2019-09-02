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
<div class="lg:flex lg:-mx-4 -mt-2">
  <div class="lg:w-5/6 lg:px-4 mb-4">
    <div class="mobile-wide relative text-center">
      @if (null !== $next)
        <a class="absolute top-0 w-1/2 h-full z-10 left-0 js-pjax js-pjax-no-dim" id="prev_page" href="{{ path("$self@show", [$next->id, 'city_id' => $city_id, 'country_id' => $country_id, 'tag_id' => $tag_id, 'trip_id' => $trip_id]) }}">&nbsp;</a>
      @endif
      @if (null !== $prev)
        <a class="absolute top-0 w-1/2 h-full z-10 left-1/2 js-pjax js-pjax-no-dim" id="next_page" href="{{ path("$self@show", [$prev->id, 'city_id' => $city_id, 'country_id' => $country_id, 'tag_id' => $tag_id, 'trip_id' => $trip_id]) }}">&nbsp;</a>
      @endif
      <div class="inline-block relative">
        @if (null !== $next)
          <div class="absolute top-1/2 left-0 text-base md:text-2xl leading-none text-white svg-shadow -mt-2 md:-mt-3 pl-1">
            @svg (chevron-left)
          </div>
        @endif
        @if (null !== $prev)
          <div class="absolute top-1/2 right-0 text-base md:text-2xl leading-none text-white photo-overlay-arrowt -mt-2 md:-mt-3 pr-1">
            @svg (chevron-right)
          </div>
        @endif
        <img class="photo-show-img" src="{{ $photo->originalUrl() }}" alt="">
      </div>
    </div>
  </div>
  <div class="lg:w-1/6 lg:px-4">
    <div class="flex flex-wrap md:flex-col">
      <div class="mr-2 md:mr-0 text-muted">{{ trans('photos.story') }}</div>
      <a class="flex flex-wrap items-center link-parent" href="{{ $photo->rel->www() }}#{{ basename($photo->slug) }}">
        <img class="flag-16 svg-shadow mr-1" src="{{ $photo->rel->city->country->flagUrl() }}">
        <span class="link">{{ $photo->rel->title }}</span>
      </a>
    </div>

    <div class="flex flex-wrap md:flex-col mt-1 md:mt-4">
      <div class="mr-2 md:mr-0 text-muted">{{ trans('photos.date') }}</div>
      <div>{{ $photo->rel->period }} {{ $photo->rel->year }}</div>
    </div>

    <div class="mt-4">
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
      <div class="mt-4">
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
