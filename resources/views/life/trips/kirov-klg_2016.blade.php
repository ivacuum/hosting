@extends('life.trips.base')

@section('content')
@ru
  <p>Киров в Калужской области — небольшой город, после которого даже родная <a class="link" href="kaluga">Калуга</a> кажется мегаполисом.</p>
@endru

@ru
  <p>Места для прогулок. Весь город можно назвать таковым.</p>
@en
  <p>Places for a walk—the whole city is actually.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0422.jpg',
  'IMG_0414.jpg',
  'IMG_0419.jpg',
  'IMG_0420.jpg',
  'IMG_0409.jpg',
]])

<a name="trees"></a>
@ru
  <p>Хороша аллея выросла.</p>
@en
  <p>A good allee has grown.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0405.jpg'])

@ru
  <p>Одуванчики.</p>
@en
  <p>Dandelions.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0395.jpg'])

@ru
  <p>Пожарная лестница.</p>
@en
  <p>Fire escape.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0404.jpg'])

@ru
  <p>Озеро и речка, места для купания.</p>
@en
  <p>Lake and river—places for swimming.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0407.jpg',
  'IMG_0418.jpg',
  'IMG_0426.jpg',
]])

@ru
  <p>Зачем ящички?</p>
@en
  <p>What are these boxes for?</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0427.jpg'])
@endsection
