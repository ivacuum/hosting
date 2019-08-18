@extends('photos.base')

@section('content')
<div class="d-flex flex-wrap mobile-wide">
  @foreach ($photos as $photo)
    <div class="flex-basis-100 flex-sm-basis-50 flex-lg-basis-33 tw-mx-auto md:tw-mx-0">
      <a href="{{ $photo->www() }}">
        <img class="image-fit-cover image-sm-4x3-2col image-lg-4x3-3col" src="{{ $photo->thumbnailUrl() }}">
      </a>
    </div>
  @endforeach
</div>

@include('tpl.paginator', ['paginator' => $photos])
@endsection
