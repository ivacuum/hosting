@extends('gallery.base')

@section('content')
<div class="text-center">
  <img class="image-fit-viewport screenshot" src="{{ $image->originalUrl() }}">
</div>

<div class="row mt-4">
  <div class="col-lg-6 offset-lg-3">
    <div>Ссылка:</div>
    <input class="form-control js-highlight" value="{{ $image->originalUrl() }}">
    <div class="mt-2">Полная картинка:</div>
    <input class="form-control js-highlight" value="[img]{{ $image->originalUrl() }}[/img]">
  </div>
</div>
@endsection
