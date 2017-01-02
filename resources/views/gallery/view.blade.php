@extends('base')

@section('content')
<div class="text-center">
  <img class="screenshot" src="{{ $image->originalUrl() }}">
</div>

<div class="row m-t-2">
  <div class="col-md-6 col-md-offset-3">
    <p>Ссылка:<br><input class="form-control" type="text" value="https://img.ivacuum.ru/g/{{ $image->date }}/{{ $image->slug }}"></p>
    <p>Полная картинка:<br><input class="form-control" type="text" value="[img]https://img.ivacuum.ru/g/{{ $image->date }}/{{ $image->slug }}[/img]"></p>
  </div>
</div>
@endsection
