@extends('gallery.base')

@section('content')
@if (sizeof($images))
  <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 items-end text-center mb-8">
    @foreach ($images as $image)
      <div>
        <a class="screenshot-link" href="{{ path([$controller, 'view'], $image) }}">
          <img class="inline-block screenshot" src="{{ $image->thumbnailUrl() }}" alt="">
        </a>
        <div class="text-muted whitespace-no-wrap mt-4">
          @svg (eye)
          {{ ViewHelper::number($image->views) }}
        </div>
      </div>
    @endforeach
  </div>

  @include('tpl.paginator', ['paginator' => $images])
@else
  @ru
    <p>Ваша галерея в данный момент пуста. <a class="link" href="{{ path([App\Http\Controllers\Gallery::class, 'upload']) }}">Загрузите</a> свое первое изображение.</p>
  @en
    <p>Your gallery is empty. <a class="link" href="{{ path([App\Http\Controllers\Gallery::class, 'upload']) }}">Upload</a> your first image right now.</p>
  @endru
@endif
@endsection
