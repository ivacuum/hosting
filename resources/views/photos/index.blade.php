@extends('photos.base')

@section('content')
<div class="grid md:grid-cols-2 lg:grid-cols-3 -mx-4 sm:mx-0">
  @foreach ($photos as $photo)
    <div>
      <a class="block relative w-full pb-[75%]" href="{{ $photo->www() }}">
        <img class="absolute top-0 left-0 w-full object-cover" src="{{ $photo->thumbnailUrl() }}" alt="">
      </a>
    </div>
  @endforeach
</div>

@include('tpl.paginator', ['paginator' => $photos])
@endsection
