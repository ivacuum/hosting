@extends('life.base', [
  'meta_title' => $trip->metaTitle(),
  'meta_image' => $trip->metaImage(),
  'meta_description' => $trip->metaDescription(),
])

@section('content_header')
@parent
@include('tpl.city-timeline')
<h1 class="h2 mt-0">
  {{ $trip->city->country->emoji }}
  {{ $trip->title }}
  @include('tpl.city-map-button', ['city' => $trip->city])
</h1>
<time datetime="{{ $trip->date_start->toDateString() }}"></time>
<div hidden id="trip_city_map" class="trip-city-map"></div>

<div class="trip-text js-trip-shortcuts">
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
