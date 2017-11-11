@extends('photos.base')

@section('content')
<h3 class="mt-0">{{ $country->title }} <small>{{ sizeof($photos) }}</small></h3>
<div class="d-flex flex-wrap mobile-wide">
  @foreach ($photos as $photo)
    <div class="flex-sm-basis-50 flex-md-basis-33 mx-auto mx-sm-0">
      <a href="{{ path("$self@show", [$photo, $country->getForeignKey() => $country]) }}">
        <img class="image-fit-cover image-sm-4x3-2col image-md-4x3-3col" src="{{ $photo->thumbnailUrl() }}">
      </a>
    </div>
  @endforeach
</div>
@endsection
