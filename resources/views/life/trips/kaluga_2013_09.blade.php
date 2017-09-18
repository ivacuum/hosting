@extends('life.trips.base')

@section('content')
@ru
  <p>Общественный траспорт сближает калужан.</p>
@en
  <p>Public transport makes Kaluga's citizens closer.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0212.jpg'])

@ru
  <p>Осень.</p>
@en
  <p>Fall.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0242.jpg',
  'IMG_0232.jpg',
]])
@endsection
