@extends('life.trips.base')

@section('content')
@ru
  <p>Дело к дождю.</p>
@en
  <p>It's going to rain.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_8783.jpg',
  'IMG_8784.jpg',
  'IMG_8785.jpg',
  'IMG_8786.jpg',
  'IMG_8787.jpg',
  'IMG_8788.jpg',
  'IMG_8789.jpg',
]])

@ru
  <p>Дело к закату.</p>
@en
  <p>It's going to be a sunset.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_8791.jpg',
  'IMG_8792.jpg',
  'IMG_8793.jpg',
  'IMG_8794.jpg',
  'IMG_8795.jpg',
  'IMG_8798.jpg',
  'IMG_8800.jpg',
  'IMG_8803.jpg',
]])

@ru
  <p>Дело к стройке.</p>
@en
  <p>It's going to be a construction.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_8808.jpg',
  'IMG_8809.jpg',
  'IMG_8810.jpg',
]])

@ru
  <p>Тоннель.</p>
@en
  <p>Tunnel.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_8790.jpg'])

@ru
  <p>Женщина с ребенком ловко переходит широкую дорогу.</p>
@en
  <p>A woman with a child skillfully crosses a wide road.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_8804.jpg'])

@ru
  <p>Тропинка вдоль забора.</p>
@en
  <p>Path along the fence.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_8807.jpg'])

@ru
  <p>В Калуге много железнодорожных путей прямо в городе.</p>
@en
  <p>There are many railroads right in the city.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_8811.jpg'])
@endsection
