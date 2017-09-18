@extends('life.trips.base')

@section('content')
@ru
  <p>Купаемся.</p>
@en
  <p>Swimming.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0749.jpg',
  'IMG_0750.jpg',
  'IMG_0751.jpg',
  'IMG_0752.jpg',
]])
@endsection
