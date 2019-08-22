@extends('photos.base')

@section('content')
<h3>{{ $city->title }} <small class="tw-text-base tw-text-gray-600">{{ sizeof($photos) }}</small></h3>
<div class="tw-flex tw-flex-wrap tw-mobile-wide">
  @foreach ($photos as $photo)
    <div class="tw-w-full sm:tw-w-1/2 lg:tw-w-1/3 tw-mx-auto sm:tw-mx-0">
      <a class="tw-block tw-relative tw-w-full tw-pb-3/4" href="{{ path("$self@show", [$photo, $city->getForeignKey() => $city]) }}">
        <img class="tw-absolute tw-top-0 tw-left-0 tw-w-full tw-object-cover" src="{{ $photo->thumbnailUrl() }}">
      </a>
    </div>
  @endforeach
</div>
@endsection
