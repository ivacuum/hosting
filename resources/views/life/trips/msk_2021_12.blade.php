@extends('life.trips.base')

@section('content')
@ru
  <p>Новогодний вагон метро.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_8903.jpg'])

@ru
  <p>Украшенные улицы.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_8904.jpg',
  'IMG_8929.jpg',
  'IMG_8930.jpg',
  'IMG_8932.jpg',
]])

@ru
  <p>Внутри ГУМа.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_8908.jpg'])

@ru
  <p>На каждом входе в ГУМ рамки металлодетекторов.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_8910.jpg'])

@ru
  <p>Красная площадь украшена.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_8912.jpg',
  'IMG_8924.jpg',
]])

@ru
  <p>На ярмарке продают елки.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_8925.jpg'])

@ru
  <p>Парк Зарядье.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_8926.jpg'])

@ru
  <p>Березы.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_8927.jpg'])

@ru
  <p>В каждом торговом центре использованы километры гирлянд.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_8931.jpg'])

@ru
  <p>Подарочный ЦУМ.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_8933.jpg'])

@ru
  <p>Внутри ЦУМа.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_8934.jpg'])
@endsection
