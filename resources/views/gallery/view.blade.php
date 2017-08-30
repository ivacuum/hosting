@extends('gallery.base')

@section('content')
<div class="text-center">
  <img class="screenshot" src="{{ $image->originalUrl() }}">
</div>

<div class="row mt-4">
  <div class="col-md-6 col-md-offset-3">
    <div>Ссылка:</div>
    <input class="form-control" value="{{ $image->originalUrl() }}">
    <div class="mt-2">Полная картинка:</div>
    <input class="form-control" value="[img]{{ $image->originalUrl() }}[/img]">
  </div>
</div>
@endsection
