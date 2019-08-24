@extends('gallery.base')

@section('content')
<div class="tw-text-center">
  <img class="image-fit-viewport screenshot" src="{{ $image->originalUrl() }}">
</div>

<div class="tw-mx-auto tw-max-w-xl tw-mt-6">
  <div>Ссылка:</div>
  <input class="form-control tw-select-all" value="{{ $image->originalUrl() }}">
  <div class="tw-mt-2">Полная картинка:</div>
  <input class="form-control tw-select-all" value="[img]{{ $image->originalUrl() }}[/img]">
</div>
@endsection
