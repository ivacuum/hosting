@extends('life.trips.base')

@section('content')
@ru
  <p>Деревни в Голландии хороши. Рядом с Роттердамом находится Киндердейк.</p>
@en
  <p>Villages are beautiful in Netherlands. This is Kinderdijk, it's located near Rotterdam.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2546.jpg'])

@ru
  <p>Путь по деревне.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2525.jpg',
  'IMG_2527.jpg',
  'IMG_2528.jpg',
  'IMG_2529.jpg',
  'IMG_2547.jpg',
  'IMG_2548.jpg',
]])

@ru
  <p>Водоем.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2532.jpg'])

@ru
  <p>Мельницы. Много мельниц.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2533.jpg',
  'IMG_2549.jpg',
  'IMG_2558.jpg',
  'IMG_2561.jpg',
  'IMG_2566.jpg',
  'IMG_2580.jpg',
  'IMG_2586.jpg',
  'IMG_2587.jpg',
]])

@ru
  <p>Улица.</p>
@en
  <p>Street.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2538.jpg'])

@ru
  <p>Табличка с номером дома.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2539.jpg'])

@ru
  <p>Домик.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2540.jpg'])

@ru
  <p>Еще табличка с номером дома.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2541.jpg'])

@ru
  <p>Дверной звонок.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2542.jpg'])

@ru
  <p>Пешеходы и велосипедисты перемещаются в отдалении от проезжей части.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2543.jpg'])

@ru
  <p>Частная территория.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2557.jpg'])

@ru
  <p>Луга.</p>
@en
  <p>Meadows.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2562.jpg',
  'IMG_2574.jpg',
]])

@ru
  <p>Листья кувшинки.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2588.jpg'])

@ru
  <p>Лошадки.</p>
@en
  <p>Horses.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2589.jpg',
  'IMG_2601.jpg',
]])
@endsection
