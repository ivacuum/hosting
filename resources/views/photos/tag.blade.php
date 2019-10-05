@extends('photos.base')

@section('content')
<h3>#{{ $tag->title }} <span class="text-base text-muted">{{ sizeof($photos) }}</span></h3>
<div class="flex flex-wrap mobile-wide">
  @foreach ($photos as $photo)
    <div class="w-full sm:w-1/2 lg:w-1/3 mx-auto sm:mx-0">
      <a class="block relative w-full pb-3/4" href="{{ path("$self@show", [$photo, $tag->getForeignKey() => $tag]) }}">
        <img class="absolute top-0 left-0 w-full object-cover" src="{{ $photo->thumbnailUrl() }}" alt="">
      </a>
    </div>
  @endforeach
</div>
@endsection
