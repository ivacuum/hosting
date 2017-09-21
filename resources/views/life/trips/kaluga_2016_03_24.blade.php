@extends('life.trips.base')

@section('content')
@ru
  <p>Два похожих состава. Где экспресс и где электричка?</p>
@en
  <p>Two similar trains. Which one is the express and which one is the local train?</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0123.jpg'])

@ru
  <p>На маршрут выставили прокачанную электричку с кондиционерами, туалетами, местами для инвалидов и велосипедов. И да — на фото выше она справа.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0124.jpg'])

@ru
  <p>Пассажирский салон.</p>
@en
  <p>Passenger cabin.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0126.jpg'])

@ru
  <p>В Москве уже поджидает аэроэкспресс. Благодаря четкому интервалу следования состава, до аэропорта можно приезжать на вокзал буквально за полтора часа до вылета.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0127.jpg'])
@endsection
