@extends('photos.base')

@section('content')
<h3>{{ $trip->breadcrumb() }} <small class="text-muted">{{ sizeof($photos) }}</small></h3>
<div class="d-flex flex-wrap mobile-wide">
  @foreach ($photos as $photo)
    <div class="flex-basis-100 flex-sm-basis-50 flex-lg-basis-33 mx-auto mx-sm-0">
      <a href="{{ path("$self@show", [$photo, $trip->getForeignKey() => $trip]) }}">
        <img class="image-fit-cover image-sm-4x3-2col image-lg-4x3-3col" src="{{ $photo->thumbnailUrl() }}">
      </a>
    </div>
  @endforeach
</div>
@endsection
