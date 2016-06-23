@extends('life.trips.base')

@section('content')
<p>Киров в Калужской области — небольшой город, после которого даже родная <a class="link" href="/life/kaluga">Калуга</a> кажется мегаполисом.</p>

<p>Места для прогулок. Весь город можно назвать таковым.</p>
@include('tpl.fotorama', ['pics' => [
  'IMG_0422.jpg',
  'IMG_0414.jpg',
  'IMG_0419.jpg',
  'IMG_0420.jpg',
  'IMG_0409.jpg',
]])

<a name="trees"></a>
<p>Хороша аллея выросла.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0405.jpg'])

<p>Одуванчики.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0395.jpg'])

<p>Пожарная лестница.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0404.jpg'])

<p>Озеро и речка, места для купания.</p>
@include('tpl.fotorama', ['pics' => [
  'IMG_0407.jpg',
  'IMG_0418.jpg',
  'IMG_0426.jpg',
]])

<p>Зачем ящички?</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0427.jpg'])
@endsection
