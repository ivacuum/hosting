@extends('acp.dev.base')

@section('content')
<h2>Создание миниатюр</h2>
<div class="mw-500">
  <images-uploader action="/acp/dev/thumbnails"></images-uploader>
</div>

<a class="btn btn-default tw-mt-6" href="{{ path("$self@clean") }}">Почистить папку с загруженными файлами</a>
@endsection
