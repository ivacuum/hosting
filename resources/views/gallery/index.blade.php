@extends('base')

@section('content')
@if (sizeof($images))
  <div>
    @foreach ($images as $image)
      <a class="gallery-photo-container" href="{{ action("$self@preview", $image) }}">
        <img class="gallery-photo" src="{{ $image->thumbnailUrl() }}">
        <span class="image-label">@svg (eye) {{ $image->views }} &middot; {{ ViewHelper::size($image->size) }}</span>
      </a>
    @endforeach
  </div>
@else
  <p>Вы не загрузили ни одного изображения.</p>
@endif

<div class="m-t-1 pull-right clearfix">
  @include('tpl.paginator', ['paginator' => $images])
</div>
@endsection
