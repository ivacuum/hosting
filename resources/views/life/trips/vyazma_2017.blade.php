@extends('life.trips.base')

@section('content')
@ru
  <p>Калуга—Брюгге. Реально? Да! Поехали!</p>
@en
  <p>Kaluga—Bruges. Is it real? Yes! Let's go!</p>
@endru

@ru
  <p>Остановка в форме зонтика.</p>
@en
  <p>Bus stop has an umbrella as a roof.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1883.jpg'])

@ru
  <p>Вид поближе.</p>
@en
  <p>A closer look.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1884.jpg'])

@ru
  <p>Не задерживаемся, продолжаем путь на запад.</p>
@en
  <p>We don't slow down. Moving on to the west.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1886.jpg'])
@endsection
