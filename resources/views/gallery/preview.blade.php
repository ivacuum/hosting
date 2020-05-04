@extends('gallery.base')

@section('content')
<div class="grid lg:grid-cols-12 xl:grid-cols-6 gap-8">
  <div class="lg:col-span-3 xl:col-span-1 text-center">
    <a href="{{ path([$controller, 'view'], $image) }}">
      <img class="inline-block screenshot" src="{{ $image->thumbnailUrl() }}" alt="">
    </a>
  </div>
  <div class="lg:col-span-7 xl:col-span-3">
    <div>Ссылка:</div>
    <input class="form-input select-all" value="{{ $image->originalUrl() }}">
    <div class="mt-2">Полная картинка:</div>
    <input class="form-input select-all" value="[img]{{ $image->originalUrl() }}[/img]">
    {{-- TODO: thumb --}}
  </div>
</div>
@endsection
