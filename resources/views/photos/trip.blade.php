@extends('photos.base')

@section('content')
<h3>{{ $trip->breadcrumb() }} <span class="text-base text-muted">{{ sizeof($photos) }}</span></h3>
<div class="grid md:grid-cols-2 lg:grid-cols-3 mobile-wide">
  @foreach ($photos as $photo)
    <div>
      <a
        class="block relative w-full pb-3/4"
        href="{{ to('photos/{photo}', [$photo, $trip->getForeignKey() => $trip]) }}"
      >
        <img class="absolute top-0 left-0 w-full object-cover" src="{{ $photo->thumbnailUrl() }}" alt="">
      </a>
    </div>
  @endforeach
</div>
@endsection
