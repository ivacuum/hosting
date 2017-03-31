@extends('photos.base')

@section('content')
<h3 class="mt-0">{{ $country->title }} <small>{{ sizeof($photos) }}</small></h3>
<div class="gallery-flex">
  @foreach ($photos as $photo)
    <div class="gallery-image mb-4">
      <a class="screenshot-link" href="{{ action("$self@show", [$photo, $country->getForeignKey() => $country]) }}">
        <img class="image-200 screenshot" src="{{ $photo->thumbnailUrl() }}">
      </a>
    </div>
  @endforeach
</div>
@endsection
