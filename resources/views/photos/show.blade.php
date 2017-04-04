@extends('photos.base')

@section('content')
<div class="row">
  <div class="col-md-10 mb-3">
    <div class="photo-show-container">
      @if (!is_null($next))
        <a class="photo-show-nav photo-show-prev js-pjax js-pjax-no-dim" id="previous_page" href="{{ path("$self@show", [$next->id, 'city_id' => $city_id, 'country_id' => $country_id, 'tag_id' => $tag_id]) }}">&nbsp;</a>
        <div class="fotorama__arr fotorama__arr--prev no-pointer-events" tabindex="0" role="button"></div>
      @endif
      @if (!is_null($prev))
        <a class="photo-show-nav photo-show-next js-pjax js-pjax-no-dim" id="next_page" href="{{ path("$self@show", [$prev->id, 'city_id' => $city_id, 'country_id' => $country_id, 'tag_id' => $tag_id]) }}">&nbsp;</a>
        <div class="fotorama__arr fotorama__arr--next no-pointer-events" tabindex="0" role="button"></div>
      @endif
      <img class="photo-show-img" src="{{ $photo->originalUrl() }}">
    </div>
  </div>
  <div class="col-md-2">
    <div class="text-muted">{{ trans('photos.story') }}</div>
    <div>
      {{ $photo->rel->city->country->emoji }}
      <a class="link" href="{{ $photo->rel->www() }}#{{ basename($photo->slug) }}">{{ $photo->rel->title }}</a>
    </div>

    <div class="mt-3 text-muted">{{ trans('photos.date') }}</div>
    <div>{{ $photo->rel->period }} {{ $photo->rel->year }}</div>

    <div class="mt-3">
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
      <div class="mt-3">
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
@if (!is_null($prev))
  <img hidden src="{{ $prev->originalUrl() }}">
@endif
@if (!is_null($next))
  <img hidden src="{{ $next->originalUrl() }}">
@endif
@endsection
