@extends('acp.dev.base')

@section('content')
<h2>Создание миниатюр</h2>
<div class="max-w-500px">
  <images-uploader action="/acp/dev/thumbnails"></images-uploader>
</div>

<a class="btn btn-default mt-6" href="{{ path("$self@clean") }}">Почистить папку с загруженными файлами</a>
@endsection
