<?php
/** @var \App\Photo $photo */
?>

@extends('photos.base')

@section('content')
<h3>{{ $country->title }} <span class="text-base text-muted">{{ sizeof($photos) }}</span></h3>
<div class="grid md:grid-cols-2 lg:grid-cols-3 mobile-wide">
  @foreach ($photos as $photo)
    <div>
      <a
        class="block relative w-full pb-3/4"
        href="{{ to('photos/{photo}', [$photo, $country->getForeignKey() => $country]) }}"
      >
        <img
          class="absolute top-0 left-0 w-full object-cover js-lazy"
          src="https://life.ivacuum.org/0.gif"
          data-srcset="{{ $photo->thumbnailUrl() }} 500w"
          alt=""
        >
      </a>
    </div>
  @endforeach
</div>
@endsection
