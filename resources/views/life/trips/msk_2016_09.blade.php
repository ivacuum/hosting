@extends('life.trips.base')

@section('content')
@ru
  <p>В Москве самые красивые станции метро.</p>
@en
  <p>Moscow has the most beautiful metro stations.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1338.jpg'])

@ru
  <p>И минимальный интервал движения поездов около двух минут</p>
@en
  <p>It also has the lowest time interval between trains which is about two minutes long.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1340.jpg'])
@endsection
