@extends('life.trips.base')

@section('content')
@ru
  <p>В первом классе брянского поезда Иван Паристый дают воду и немного еды.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_8750.jpg'])

@ru
  <p>Компоновка сидений 2+1.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_8751.jpg'])

@ru
  <p>Электробусы заряжаются на парковке возле Киевского вокзала.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_8753.jpg'])

@ru
  <p>Здание гостиницы Славянская.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_8754.jpg'])

@ru
  <p>Лестница на мосту в отсутствие работающего эскалатора.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_8755.jpg'])

@ru
  <p>Внутреннее оформление моста.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_8756.jpg'])

@ru
  <p>Осенние краски.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_8758.jpg',
  'IMG_8759.jpg',
  'IMG_8760.jpg',
]])

@ru
  <p>Напомнило карту организаций в <a class="link" href="onomichi.2019#2gis">Японии</a>.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_8761.jpg'])

@ru
  <p>Хотя это были энциклопедии на полке книжного магазина.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_8762.jpg'])
@endsection
