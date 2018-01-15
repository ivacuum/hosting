@extends('life.base', [
  'meta_title' => $trip->metaTitle(),
  'meta_image' => $trip->metaImage(),
  'meta_description' => $trip->metaDescription(),
])

@section('content_header')
@parent
@include('tpl.city-timeline')
<div class="d-flex flex-wrap align-items-center mb-2">
  <h1 class="h2 mb-1 mr-2">
    {{ $trip->city->country->emoji }}
    {{ $trip->title }}
  </h1>
  @include('tpl.city-map-button', ['city' => $trip->city])
  @if (optional(auth()->user())->isRoot())
    <a class="btn btn-default btn-sm" href="{{ UrlHelper::edit('Acp\Trips', $trip) }}">
      @svg (pencil)
    </a>
  @endif
</div>
<time datetime="{{ $trip->date_start->toDateString() }}"></time>
<div id="trip_city_map" class="trip-city-map mb-3" style="display: none;"></div>

<div class="mw-1000 js-trip-shortcuts">
@endsection

@section('content_footer')
</div>

@include('tpl.trips-timeline')
@parent

@if (isset($comments))
  @include('tpl.comments-list')
  @include('tpl.comment-add', ['params' => ['trip', $trip->id]])
@endif
@endsection
