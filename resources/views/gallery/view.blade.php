@extends('gallery.base')

@section('content')
<div class="text-center">
  <img class="image-fit-viewport inline-block screenshot" src="{{ $image->originalUrl() }}" alt="">
</div>

<div class="mx-auto max-w-xl mt-6">
  <div>Ссылка:</div>
  <input class="form-input select-all" type="text" value="{{ $image->originalUrl() }}">
  <div class="mt-2">Полная картинка:</div>
  <input class="form-input select-all" type="text" value="[img]{{ $image->originalUrl() }}[/img]">
</div>
@endsection
