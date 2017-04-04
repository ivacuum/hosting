@extends('photos.base')

@section('content')
<div class="gallery-flex">
  @foreach ($photos as $photo)
    <div class="gallery-image mb-4">
      <a class="screenshot-link" href="{{ $photo->www() }}">
        <img class="image-200 screenshot" src="{{ $photo->thumbnailUrl() }}">
      </a>
    </div>
  @endforeach
</div>

@include('tpl.paginator', ['paginator' => $photos])
@endsection
