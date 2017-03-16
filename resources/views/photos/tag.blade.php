@extends('photos.base')

@section('content')
<h3 class="mt-0">#{{ $tag->title }}</h3>
<div>
  @foreach ($tag->photos as $photo)
    <a class="screenshot-link" href="{{ action("$self@show", [$photo, 'tag_id' => $tag]) }}">
      <img class="image-200 screenshot" src="{{ $photo->thumbnailUrl() }}">
    </a>
  @endforeach
</div>
@endsection
