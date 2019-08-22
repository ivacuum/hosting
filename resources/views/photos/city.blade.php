@extends('photos.base')

@section('content')
<h3>{{ $city->title }} <small class="tw-text-base tw-text-gray-600">{{ sizeof($photos) }}</small></h3>
<div class="tw-flex tw-flex-wrap tw-mobile-wide">
  @foreach ($photos as $photo)
    <div class="tw-w-full sm:tw-w-1/2 lg:tw-w-1/3 tw-mx-auto sm:tw-mx-0">
      <a href="{{ path("$self@show", [$photo, $city->getForeignKey() => $city]) }}">
        <img class="image-fit-cover image-sm-4x3-2col image-lg-4x3-3col" src="{{ $photo->thumbnailUrl() }}">
      </a>
    </div>
  @endforeach
</div>
@endsection
