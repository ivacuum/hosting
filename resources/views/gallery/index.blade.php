@extends('gallery.base')

@section('content')
@if (sizeof($images))
  <div class="tw-flex tw-flex-wrap tw-text-center">
    @foreach ($images as $image)
      <div class="gallery-image tw-mb-6">
        <div class="tw-mb-4">
          <a class="screenshot-link" href="{{ path("$self@view", $image) }}">
            <img class="screenshot" src="{{ $image->thumbnailUrl() }}">
          </a>
        </div>
        <span class="text-muted tw-whitespace-no-wrap">
          @svg (eye)
          {{ ViewHelper::number($image->views) }}
        </span>
      </div>
    @endforeach
  </div>

  @include('tpl.paginator', ['paginator' => $images])
@else
  @ru
    <p>Ваша галерея в данный момент пуста. <a class="link" href="{{ path('Gallery@upload') }}">Загрузите</a> свое первое изображение.</p>
  @en
    <p>Your gallery is empty. <a class="link" href="{{ path('Gallery@upload') }}">Upload</a> your first image right now.</p>
  @endru
@endif
@endsection
