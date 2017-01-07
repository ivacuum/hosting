@extends('base')

@section('content')
@if (sizeof($images))
  <div class="gallery-flex">
    @foreach ($images as $image)
      <div class="gallery-image m-b-2">
        <div class="m-b-1">
          <a class="screenshot-link" href="{{ action("$self@view", $image) }}">
            <img class="screenshot" src="{{ $image->thumbnailUrl() }}">
          </a>
        </div>
        <span class="text-muted">
          @svg (eye)
          {{ ViewHelper::number($image->views) }}
        </span>
      </div>
    @endforeach
  </div>
@else
  <p>Вы не загрузили ни одного изображения.</p>
@endif

<div class="m-t-1 pull-right clearfix">
  @include('tpl.paginator', ['paginator' => $images])
</div>
@endsection
