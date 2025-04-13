<?php
/** @var \App\Photo $photo */
?>

@extends('photos.base')

@section('content')
<h3 class="font-medium text-2xl mb-2">{{ $city->title }} <span class="text-base text-gray-500">{{ count($photos) }}</span></h3>
<div class="grid md:grid-cols-2 lg:grid-cols-3 -mx-4 sm:mx-0">
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
