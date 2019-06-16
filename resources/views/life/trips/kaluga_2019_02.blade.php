@extends('life.trips.base')

@section('content')
@ru
  <p>Во время прогулки неприметной дорогой захвачен потрясающий закат.</p>
@en
  <p>Caught a stunning sunset, walking along an unusual trail.</p>
@endru

@include('tpl.fotorama-2x', ['pics' => [
  'IMG_7307.jpg',
  'IMG_7311.jpg',
]])
@endsection
