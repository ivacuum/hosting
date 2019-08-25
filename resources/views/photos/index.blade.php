@extends('photos.base')

@section('content')
<div class="flex flex-wrap mobile-wide">
  @foreach ($photos as $photo)
    <div class="w-full sm:w-1/2 lg:w-1/3 mx-auto md:mx-0">
      <a class="block relative w-full pb-3/4" href="{{ $photo->www() }}">
        <img class="absolute top-0 left-0 w-full object-cover" src="{{ $photo->thumbnailUrl() }}">
      </a>
    </div>
  @endforeach
</div>

@include('tpl.paginator', ['paginator' => $photos])
@endsection
