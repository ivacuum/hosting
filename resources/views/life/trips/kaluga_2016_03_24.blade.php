@extends('life.trips.base')

@section('content')
@ru
  <p>Два похожих состава. <a class="pseudo" data-toggle="feedback" data-target=".js-modal-feedback" data-question="Где экспресс и где электричка?">Где экспресс и где электричка?</a></p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0123.jpg'])

@ru
  <p>На маршрут выставили прокачанную электричку с кондиционерами, туалетами, местами для инвалидов и велосипедов. И да — на фото выше она справа.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0124.jpg'])

@ru
  <p>Пассажирский салон.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0126.jpg'])

@ru
  <p>В Москве уже поджидает аэроэкспресс. Благодаря четкому интервалу следования состава, до аэропорта можно приезжать на вокзал буквально за полтора часа до вылета.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0127.jpg'])
@endsection
