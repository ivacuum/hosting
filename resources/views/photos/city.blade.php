<?php
/** @var \App\Photo $photo */
?>

@extends('photos.base')

@section('content')
<h3>{{ $city->title }} <span class="text-base text-muted">{{ count($photos) }}</span></h3>
<div class="grid md:grid-cols-2 lg:grid-cols-3 mobile-wide">
  @foreach ($photos as $photo)
    <div>
      <a
        class="block relative w-full pb-[75%]"
        href="{{ to('photos/{photo}', [$photo, $city->getForeignKey() => $city]) }}"
      >
        <img
          class="absolute top-0 left-0 w-full object-cover"
          src="{{ $photo->thumbnailUrl() }}"
          alt=""
          loading="lazy"
        >
      </a>
    </div>
  @endforeach
</div>
@endsection
