@extends('user-travel.base', [
  'meta_title' => $trip->metaTitle(),
  'meta_image' => $trip->metaImage(),
  'meta_description' => $trip->metaDescription(),
])

@section('content_header')
@parent
@include('tpl.city-timeline')
<div class="flex flex-wrap items-center mb-2">
  <img class="flag-24 svg-shadow mr-2" src="{{ $trip->city->country->flagUrl() }}">
  <h1 class="h2 mb-1 mr-2">{{ $trip->title }}</h1>
  @include('tpl.city-map-button', ['city' => $trip->city])
  @if ($traveler->id == optional(auth()->user())->id)
    <a class="btn btn-default btn-sm" href="{{ UrlHelper::edit('MyTrips', $trip) }}">
      @svg (pencil)
    </a>
  @endif
</div>
<time datetime="{{ $trip->date_start->toDateString() }}"></time>
<div id="trip_city_map" class="mb-4 hidden mobile-wide h-1/2-screen"></div>

<article class="max-w-1000px js-trip-shortcuts">
@endsection

@section('content')
{!! $trip->html !!}
@endsection

@section('content_footer')
</article>

@include('tpl.trips-timeline')
@parent

@if (isset($comments))
  @include('tpl.comments-list')
  @include('tpl.comment-add', ['params' => ['trip', $trip->id]])
@endif
@endsection
