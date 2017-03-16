@extends('photos.base')

@section('content')
<div class="gallery-flex">
  @foreach ($photos as $photo)
    <div class="gallery-image mb-4">
      <a class="screenshot-link" href="{{ action("$self@show", $photo) }}">
        <img class="image-200 screenshot" src="{{ $photo->thumbnailUrl() }}">
      </a>
    </div>
  @endforeach
</div>
@endsection
