@extends('life.trips.base')

@section('content')
@ru
  <p>Пара ночных снимков.</p>
@en
  <p>A couple of night shots.</p>
@endlang
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_1250.jpg',
  'IMG_1247.jpg',
]])
@endsection
