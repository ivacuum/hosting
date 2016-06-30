@extends('life.trips.base')

@section('content')
<p>Общественный траспорт сближает калужан.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0212.jpg'])

<p>Осень.</p>
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0242.jpg',
  'IMG_0232.jpg',
]])
@endsection
