@extends('life.trips.base')

@section('content')
@ru
  <p>Подъезжаем.</p>
@en
  <p>Approaching.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2196.jpg'])

@ru
  <p>Проезжаем.</p>
@en
  <p>Passing by.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2198.jpg',
  'IMG_2203.jpg',
  'IMG_2206.jpg',
  'IMG_2208.jpg',
  'IMG_2209.jpg',
  'IMG_2211.jpg',
  'IMG_2215.jpg',
  'IMG_2218.jpg',
]])
@endsection
