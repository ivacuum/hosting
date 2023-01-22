@extends('life.trips.base')

@section('content')
@ru
  <p>Станция метро Мичуринский проспект.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_7697.jpg',
  'IMG_7698.jpg',
  'IMG_7699.jpg',
]])

@ru
  <p>Опробован каршеринг. Если автомобиль не заводится, то может помочь ребут — приостановить поездку, подождать десять секунд, затем продолжить поездку. Цена на двоих сопоставима с такси. А по пробкам ехать вообще непривлекательно по цене выходит. Стоит пользоваться навигатором автомобиля, нежели свой телефон разряжать.</p>
@endru

@ru
  <p>Царицыно.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_7702.jpg',
  'IMG_7701.jpg',
]])

@ru
  <p>Фонтан.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_7700.jpg'])

@ru
  <p>Много желающих сфотографироваться на фоне цветущей сакуры.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_7703.jpg'])

@ru
  <p>Пруд.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_7704.jpg'])

@ru
  <p>Лежаки перед прудом.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_7705.jpg'])

@ru
  <p>Аллеи.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_7706.jpg',
  'IMG_7707.jpg',
]])

@ru
  <p>Вход на станцию метро Тверская.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_7708.jpg'])
@endsection
