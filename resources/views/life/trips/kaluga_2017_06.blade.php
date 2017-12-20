@extends('life.trips.base')

@section('content')
@ru
  <p>Кубики подвешены.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1857.jpg'])

@ru
  <p>Редкий случай, оба пути восьмой платформы свободны — обычно экспресс или электричка ждут отправления.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1863.jpg'])

@ru
  <p>Редкий случай, когда сквозь город идет состав, перекрывая движение автотранспорта.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1880.jpg'])

@ru
  <p>Надвигается трындец.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_1865.jpg',
  'IMG_1867.jpg',
  'IMG_1870.jpg',
]])

@ru
  <p>После трындеца, конечно, плаваем. Предприимчивые люди могли бы сдавать лодку в аренду. Или хотя бы сапоги.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1876.jpg'])

@ru
  <p>Отправляемся в евротур до Брюгге.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1882.jpg'])
@endsection
