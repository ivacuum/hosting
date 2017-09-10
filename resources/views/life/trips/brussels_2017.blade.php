@extends('life.trips.base')

@section('content')
@ru
  <p>Путь в Голландию с остановкой на обед в столице Бельгии.</p>
@en
  <p>On the way to Netherlands with a brief stop for a lunch in the capital of Belgium.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2415.jpg'])

@ru
  <p>Почтовый ящик.</p>
@en
  <p>Postbox.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2418.jpg'])

@ru
  <p>Улицы.</p>
@en
  <p>Streets.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2420.jpg',
  'IMG_2421.jpg',
  'IMG_2424.jpg',
  'IMG_2425.jpg',
  'IMG_2428.jpg',
  'IMG_2430.jpg',
  'IMG_2431.jpg',
  'IMG_2432.jpg',
  'IMG_2436.jpg',
]])

@ru
  <p>На главной площади трибуны предположительно для зрителей конных мероприятий.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2426.jpg'])

@ru
  <p>Уличные музыканты.</p>
@en
  <p>Street musicians.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2427.jpg'])

@ru
  <p>У каждого этажа подземной парковки свой цвет и животное.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2437.jpg',
  'IMG_2439.jpg',
  'IMG_2440.jpg',
  'IMG_2441.jpg',
]])

@ru
  <p>Выезд из подземного тоннеля. Коллекция снимков из автомобиля пополнилась на пару лет вперед.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2445.jpg'])

@ru
  <p>Не задерживаемся — держим путь на Роттердам.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2446.jpg'])
@endsection
