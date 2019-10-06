@extends('gallery.base')

@section('content')
<div class="lg:flex lg:-mx-4">
  <div class="lg:w-1/4 xl:w-1/6 lg:px-4 text-center">
    <a href="{{ path([$controller, 'view'], $image) }}">
      <img class="inline-block screenshot" src="{{ $image->thumbnailUrl() }}" alt="">
    </a>
  </div>
  <div class="lg:w-7/12 xl:w-1/2 lg:px-4 mt-6 md:mt-0">
    <div>Ссылка:</div>
    <input class="form-control select-all" value="{{ $image->originalUrl() }}">
    <div class="mt-2">Полная картинка:</div>
    <input class="form-control select-all" value="[img]{{ $image->originalUrl() }}[/img]">
    {{-- TODO: thumb --}}
  </div>
</div>
@endsection
