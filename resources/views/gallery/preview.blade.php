@extends('gallery.base')

@section('content')
<div class="row">
  <div class="col-md-2 col-md-offset-2 text-center">
    <div class="mb-3">
      <a href="{{ path("$self@view", $image) }}">
        <img class="screenshot" src="{{ $image->thumbnailUrl() }}">
      </a>
    </div>
  </div>
  <div class="col-md-6">
    <div>Ссылка:</div>
    <input class="form-control" value="{{ $image->originalUrl() }}">
    <div class="mt-2">Полная картинка:</div>
    <input class="form-control" value="[img]{{ $image->originalUrl() }}[/img]">
    {{-- TODO: thumb --}}
  </div>
</div>
@endsection
