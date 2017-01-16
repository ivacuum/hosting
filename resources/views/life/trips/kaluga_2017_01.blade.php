@extends('life.trips.base')

@section('content')
@ru
  <p>Мороз и солнце, день чудесный!</p>
@en
  <p>Frost and sunshine, what a wonderful day!</p>
@endlang
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3149.jpg',
  'IMG_3150.jpg',
  'IMG_3151.jpg',
  'IMG_3152.jpg',
  'IMG_3154.jpg',
]])
@endsection
