@extends('gallery.base')

@section('content')
@if (sizeof($images))
  <div class="flex flex-wrap text-center">
    @foreach ($images as $image)
      <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5 self-end mb-6">
        <div class="mb-4">
          <a class="screenshot-link" href="{{ path("$self@view", $image) }}">
            <img class="screenshot" src="{{ $image->thumbnailUrl() }}" alt="">
          </a>
        </div>
        <span class="text-muted whitespace-no-wrap">
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
