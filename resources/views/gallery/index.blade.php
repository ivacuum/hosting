<?php /** @var App\Image $image */ ?>

@extends('gallery.base')

@section('content')
@if (count($images))
  <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 items-end text-center mb-8">
    @foreach ($images as $image)
      <div>
        <a class="screenshot-link" href="@lng/gallery/view/{{ $image->id }}">
          <img class="inline-block screenshot" src="{{ $image->thumbnailUrl() }}" alt="">
        </a>
        <div class="text-gray-500 whitespace-nowrap mt-4">
          @svg (eye)
          {{ ViewHelper::number($image->views) }}
        </div>
      </div>
    @endforeach
  </div>

  @include('tpl.paginator', ['paginator' => $images])
@else
  @ru
    <p>Ваша галерея в данный момент пуста. <a class="link" href="@lng/gallery/upload">Загрузите</a> свое первое изображение.</p>
  @en
    <p>Your gallery is empty. <a class="link" href="@lng/gallery/upload">Upload</a> your first image right now.</p>
  @endru
@endif
@endsection
