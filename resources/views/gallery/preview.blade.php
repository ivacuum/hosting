@extends('gallery.base')

@section('content')
<div class="lg:tw-flex lg:tw--mx-4">
  <div class="lg:tw-w-1/4 xl:tw-w-1/6 lg:tw-px-4 tw-text-center">
    <a href="{{ path("$self@view", $image) }}">
      <img class="screenshot" src="{{ $image->thumbnailUrl() }}">
    </a>
  </div>
  <div class="lg:tw-w-7/12 xl:tw-w-1/2 lg:tw-px-4 tw-mt-6 md:tw-mt-0">
    <div>Ссылка:</div>
    <input class="form-control tw-select-all" value="{{ $image->originalUrl() }}">
    <div class="tw-mt-2">Полная картинка:</div>
    <input class="form-control tw-select-all" value="[img]{{ $image->originalUrl() }}[/img]">
    {{-- TODO: thumb --}}
  </div>
</div>
@endsection
