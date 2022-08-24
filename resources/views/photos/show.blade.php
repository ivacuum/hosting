<?php
/**
 * @var \App\Photo $photo
 * @var \App\Photo $next
 * @var \App\Photo $prev
 */
?>

@extends('photos.base')

@push('js')
<script>
Mousetrap.bind('left', () => {
  document.dispatchEvent(new Event('shortcuts.to_prev_page'))
})

Mousetrap.bind('right', () => {
  document.dispatchEvent(new Event('shortcuts.to_next_page'))
})
</script>
@endpush

@section('content')
<div class="grid lg:grid-cols-6 gap-6 -mt-2">
  <div class="lg:col-span-5">
    <div class="-mx-4 sm:mx-0 relative text-center">
      @if ($next)
        <a
          class="absolute top-0 w-1/2 h-full z-10 left-0"
          id="prev_page"
          href="{{ to('photos/{photo}', [$next->id, 'city_id' => $cityId, 'country_id' => $countryId, 'tag_id' => $tagId, 'trip_id' => $tripId]) }}"
        >&nbsp;</a>
      @endif
      @if ($prev)
        <a
          class="absolute top-0 w-1/2 h-full z-10 left-1/2"
          id="next_page"
          href="{{ to('photos/{photo}', [$prev->id, 'city_id' => $cityId, 'country_id' => $countryId, 'tag_id' => $tagId, 'trip_id' => $tripId]) }}"
        >&nbsp;</a>
      @endif
      <div class="inline-block relative">
        @if ($next)
          <div class="absolute top-1/2 left-0 text-base md:text-2xl leading-none text-white svg-shadow -mt-2 md:-mt-3 pl-1">
            @svg (chevron-left)
          </div>
        @endif
        @if ($prev)
          <div class="absolute top-1/2 right-0 text-base md:text-2xl leading-none text-white photo-overlay-arrowt -mt-2 md:-mt-3 pr-1">
            @svg (chevron-right)
          </div>
        @endif
        <img class="photo-show-img" src="{{ $photo->originalUrl() }}" alt="">
      </div>
    </div>
  </div>
  <div>
    <div class="flex flex-wrap gap-2 md:gap-0 md:flex-col">
      <div class="text-muted">@lang('История')</div>
      <a class="flex flex-wrap gap-1 items-center link-parent" href="{{ $photo->rel->www() }}#{{ basename($photo->slug) }}">
        <img class="flag-16 svg-shadow" src="{{ $photo->rel->city->country->flagUrl() }}" alt="">
        <span class="link">{{ $photo->rel->title }}</span>
      </a>
    </div>

    <div class="flex flex-wrap gap-2 md:gap-0 md:flex-col mt-1 md:mt-4">
      <div class="text-muted">@lang('Дата снимка')</div>
      <div>{{ $photo->rel->period() }} {{ $photo->rel->year }}</div>
    </div>

    <div class="mt-4">
      <div class="text-muted">
        @lang('Геотэги')
        @if ($photo->isOnMap())
          <a href="{{ to('photos/map', ['lat' => $photo->lat, 'lon' => $photo->lon, 'zoom' => 16]) }}">@svg (map-marker)</a>
        @endif
      </div>
      <div><a class="link lowercase" href="{{ to('photos/cities/{city}', $photo->rel->city->slug) }}">#{{ $photo->rel->city->title }}</a></div>
      <div><a class="link lowercase" href="{{ to('photos/countries/{country}', $photo->rel->city->country->slug) }}">#{{ $photo->rel->city->country->title }}</a></div>
    </div>

    @if (count($photo->tags))
      <div class="mt-4">
        <div class="text-muted">@lang('Тэги')</div>
        @foreach ($photo->tags as $tag)
          <div>
            <a class="link" href="{{ $tag->www() }}">#{{ $tag->title }}</a>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</div>
@if ($prev)
  <img hidden src="{{ $prev->originalUrl() }}" alt="">
@endif
@if ($next)
  <img hidden src="{{ $next->originalUrl() }}" alt="">
@endif
@endsection
