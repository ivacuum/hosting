@extends('life.trips.base')

@section('content')
@ru
  <p>Театральная площадь после дождя.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1448.jpg'])

@ru
  <p>Воздушная лужа.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1449.jpg'])

@ru
  <p>Прекрасное место для ловли закатов в Центральном парке культуры и отдыха.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1460.jpg'])

@ru
  <p>Улицы.</p>
@en
  <p>Streets.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_1775.jpg',
  'IMG_1438.jpg',
  'IMG_1441.jpg',
  'IMG_1445.jpg',
]])

@ru
  <p>Открытка <a class="link" href="copenhagen.2017">Копенгагену</a> с его кирпичными домами.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1779.jpg'])

@ru
  <p>Самолет Ютэйр заходит на посадку во Внуково.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_1759.jpg'])

@ru
  <p>Тем временем за окном между Калугой и Москвой.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_1694.jpg',
  'IMG_1768.jpg',
  'IMG_1769.jpg',
]])
@endsection
