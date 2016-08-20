@extends('life.trips.base')

@section('content')
<p lang="ru">Купаемся.</p>
@include('tpl.fotorama', ['pics' => [
  'IMG_0749.jpg',
  'IMG_0750.jpg',
  'IMG_0751.jpg',
  'IMG_0752.jpg',
]])
@endsection
