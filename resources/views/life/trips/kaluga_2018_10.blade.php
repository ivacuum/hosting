@extends('life.trips.base')

@section('content')
@ru
  <p>Осень выдалась самой яркой за последние годы.</p>
@en
  <p>The most colorful fall for the past years.</p>
@endru

@include('tpl.fotorama-2x', ['pics' => [
  'IMG_5429.jpg',
  'IMG_5430.jpg',
  'IMG_5431.jpg',
  'IMG_5434.jpg',
  'IMG_5436.jpg',
  'IMG_5438.jpg',
  'IMG_5439.jpg',
  'IMG_5441.jpg',
  'IMG_5444.jpg',
  'IMG_5449.jpg',
  'IMG_5452.jpg',
  'IMG_5455.jpg',
  'IMG_5456.jpg',
  'IMG_5460.jpg',
  'IMG_5461.jpg',
  'IMG_5464.jpg',
  'IMG_5465.jpg',
  'IMG_5467.jpg',
  'IMG_5469.jpg',
  'IMG_5471.jpg',
]])

@ru
  <p>Стенной рельеф.</p>
@en
  <p>Wall relief.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_5482.jpg'])

@ru
  <p>Циолковский в качестве символа города.</p>
@en
  <p>Tsiolkovsky as a symbol of the city.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_5486.jpg'])
@endsection
