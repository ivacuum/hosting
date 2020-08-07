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
  $(document).trigger('shortcuts.to_prev_page')
})

Mousetrap.bind('right', () => {
  $(document).trigger('shortcuts.to_next_page')
})
</script>
@endpush

@section('content')
<div class="grid lg:grid-cols-6 gap-6 -mt-2">
  <div class="lg:col-span-5">
    <div class="mobile-wide relative text-center">
      @if ($next)
        <a
          class="absolute top-0 w-1/2 h-full z-10 left-0"
          id="prev_page"
          href="{{ path([App\Http\Controllers\Photos::class, 'show'], [$next->id, 'city_id' => $cityId, 'country_id' => $countryId, 'tag_id' => $tagId, 'trip_id' => $tripId]) }}"
        >&nbsp;</a>
      @endif
      @if ($prev)
        <a
          class="absolute top-0 w-1/2 h-full z-10 left-1/2"
          id="next_page"
          href="{{ path([App\Http\Controllers\Photos::class, 'show'], [$prev->id, 'city_id' => $cityId, 'country_id' => $countryId, 'tag_id' => $tagId, 'trip_id' => $tripId]) }}"
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
    <div class="flex flex-wrap md:flex-col">
      <div class="mr-2 md:mr-0 text-muted">{{ __('История') }}</div>
      <a class="flex flex-wrap items-center link-parent" href="{{ $photo->rel->www() }}#{{ basename($photo->slug) }}">
        <img class="flag-16 svg-shadow mr-1" src="{{ $photo->rel->city->country->flagUrl() }}" alt="">
        <span class="link">{{ $photo->rel->title }}</span>
      </a>
    </div>

    <div class="flex flex-wrap md:flex-col mt-1 md:mt-4">
      <div class="mr-2 md:mr-0 text-muted">{{ __('Дата снимка') }}</div>
      <div>{{ $photo->rel->period() }} {{ $photo->rel->year }}</div>
    </div>

    <div class="mt-4">
      <div class="text-muted">
        {{ __('Геотэги') }}
        @if ($photo->isOnMap())
          <a href="{{ path([App\Http\Controllers\Photos::class, 'map'], ['lat' => $photo->lat, 'lon' => $photo->lon, 'zoom' => 16]) }}">@svg (map-marker)</a>
        @endif
      </div>
      <div><a class="link" href="{{ path([App\Http\Controllers\Photos::class, 'city'], $photo->rel->city->slug) }}">#{{ mb_strtolower($photo->rel->city->title) }}</a></div>
      <div><a class="link" href="{{ path([App\Http\Controllers\Photos::class, 'country'], $photo->rel->city->country->slug) }}">#{{ mb_strtolower($photo->rel->city->country->title) }}</a></div>
    </div>

    @if (sizeof($photo->tags))
      <div class="mt-4">
        <div class="text-muted">{{ __('Тэги') }}</div>
        @foreach ($photo->tags as $tag)
          <div>
            <a class="link" href="{{ path([App\Http\Controllers\Photos::class, 'tag'], $tag) }}">#{{ $tag->title }}</a>
          </div>
        @endforeach
      </div>
    @endif
  </div>
</div>
@if (null !== $prev)
  <img hidden src="{{ $prev->originalUrl() }}" alt="">
@endif
@if (null !== $next)
  <img hidden src="{{ $next->originalUrl() }}" alt="">
@endif
@endsection
