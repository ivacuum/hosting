@extends('life.trips.base')

@section('content')
@ru
  <p>Велопрогулка завела в дачные красоты.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3204.jpg'])

@ru
  <p>А домой повела на закате.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3206.jpg'])

@ru
  <p>Подъезд к Калуге.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3208.jpg'])
@endsection
