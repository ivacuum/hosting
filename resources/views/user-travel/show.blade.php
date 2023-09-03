<?php
/**
 * @var \App\Trip $trip
 * @var \App\User $traveler
 */
?>

@extends('user-travel.base', [
  'metaTitle' => $trip->metaTitle(),
  'metaImage' => $trip->metaImage(),
  'metaDescription' => $trip->metaDescription(),
])
@include('livewire')

@section('content_header')
@parent
@include('tpl.city-timeline')
<div class="flex flex-wrap gap-2 items-center mb-2">
  <img class="flag-24 svg-shadow" src="{{ $trip->city->country->flagUrl() }}" alt="">
  <h1 class="font-medium text-3xl tracking-tight mb-1">{{ $trip->title }}</h1>
  @include('tpl.city-map-button', ['city' => $trip->city])
  @if ($traveler->id == Auth::user()?->id)
    <a
      class="btn btn-default text-sm py-1"
      href="{{ UrlHelper::edit(App\Http\Controllers\MyTripController::class, $trip) }}"
    >
      @svg (pencil)
    </a>
  @endif
</div>
<time datetime="{{ $trip->date_start->toDateString() }}"></time>
<div id="trip_city_map" class="mb-4 hidden -mx-4 sm:mx-0 h-[50vh]"></div>

<article class="max-w-[1000px] js-trip-shortcuts">
@endsection

@section('content')
{!! $trip->html !!}
@endsection

@section('content_footer')
</article>

@include('tpl.trips-timeline')
@parent

@if (isset($comments))
  @livewire(App\Livewire\Comments::class, ['model' => $trip])
  @livewire(App\Livewire\CommentAddForm::class, ['model' => $trip])
@endif
@endsection
