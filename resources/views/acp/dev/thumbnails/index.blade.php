@extends('acp.dev.base')

@section('content')
<h2 class="mt-0">Создание миниатюр</h2>
<images-uploader></images-uploader>

<p class="mt-5">
  <a class="btn btn-default" href="{{ action("$self@clean") }}">Почистить папку с загруженными файлами</a>
</p>
@endsection
