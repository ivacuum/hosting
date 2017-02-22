@extends('gallery.base')

@section('content')
@if (sizeof($images))
  <div class="gallery-flex">
    @foreach ($images as $image)
      <div class="gallery-image mb-4">
        <div class="mb-3">
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
  @ru
    <p>Ваша галерея в данный момент пуста. <a class="link" href="{{ action('Gallery@upload') }}">Загрузите</a> свое первое изображение.</p>
  @en
    <p>Your gallery is empty. <a class="link" href="{{ action('Gallery@upload') }}">Upload</a> your first image right now.</p>
  @endlang
@endif

<div class="mt-3 text-center">
  @include('tpl.paginator', ['paginator' => $images])
</div>
@endsection
