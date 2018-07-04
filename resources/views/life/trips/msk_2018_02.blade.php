@extends('life.trips.base')

@section('content')
@ru
  <p>На Красной площади волшебно. Шары на деревьях похожи на <a class="link" href="kaluga.2018.01">однажды запечатленные в Калуге яблоки</a>.</p>
@en
  <p>Red Square is magical. Christmas balls look like <a class="link" href="kaluga.2018.01">apples I shot once in Kaluga</a>.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_5867.jpg',
  'IMG_5869.jpg',
  'IMG_5873.jpg',
  'IMG_5874.jpg',
]])

@ru
  <p>Пополнение <a class="link" href="/photos/tags/1">коллекции закатов</a> новым снимком в парке Зарядье.</p>
@en
  <p>Expanding <a class="link" href="/en/photos/tags/1">the sunset collection</a> with a new shot from Zaryadye park.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_5878.jpg'])
@endsection
