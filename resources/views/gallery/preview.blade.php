@extends('base')

@section('content')
<div class="row">
  <div class="col-md-2 col-md-offset-2 text-center">
    <p>
      <a href="{{ action("$self@view", $image) }}">
        <img class="screenshot" src="{{ $image->thumbnailSecretUrl() }}">
      </a>
    </p>
  </div>
  <div class="col-md-6">
    <p>Ссылка:<br><input class="form-control" type="text" value="https://img.ivacuum.ru/g/{{ $image->date }}/{{ $image->slug }}"></p>
    <p>Полная картинка:<br><input class="form-control" type="text" value="[img]https://img.ivacuum.ru/g/{{ $image->date }}/{{ $image->slug }}[/img]"></p>
    {{-- TODO: thumb --}}
  </div>
</div>
@endsection
