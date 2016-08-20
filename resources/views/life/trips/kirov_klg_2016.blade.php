@extends('life.trips.base')

@section('content')
<p lang="ru">Киров в Калужской области — небольшой город, после которого даже родная <a class="link" href="/life/kaluga">Калуга</a> кажется мегаполисом.</p>

<p lang="ru">Места для прогулок. Весь город можно назвать таковым.</p>
@include('tpl.fotorama', ['pics' => [
  'IMG_0422.jpg',
  'IMG_0414.jpg',
  'IMG_0419.jpg',
  'IMG_0420.jpg',
  'IMG_0409.jpg',
]])

<a name="trees"></a>
<p lang="ru">Хороша аллея выросла.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0405.jpg'])

<p lang="ru">Одуванчики.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0395.jpg'])

<p lang="ru">Пожарная лестница.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0404.jpg'])

<p lang="ru">Озеро и речка, места для купания.</p>
@include('tpl.fotorama', ['pics' => [
  'IMG_0407.jpg',
  'IMG_0418.jpg',
  'IMG_0426.jpg',
]])

<p lang="ru">Зачем ящички?</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0427.jpg'])
@endsection
