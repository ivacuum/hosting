@extends('life.trips.base')

@section('content')
@ru
  <p>Некоторые дома утеплили и перекрасили их фасады. Но на этом не остановились — имеющиеся балконы тоже стали делать соотвествующего фасаду цвета.</p>
@en
  <p>Some buildings got repainted and warmed. Now balconies are getting colored to match the facade color.</p>
@endru

@include('tpl.fotorama-2x', ['pics' => [
  'IMG_5679.jpg',
  'IMG_5681.jpg',
]])
@endsection
