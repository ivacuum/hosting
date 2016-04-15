@extends('life.trips.base')

@section('content')
<p>Полезная овощная поездка. Понял, что повторения больше не хочу.</p>
@include('tpl.fotorama', ['pics' => [
  'IMG_0621.jpg',
  'IMG_0658.jpg',
  'IMG_0659.jpg',
  'IMG_0660.jpg',
  'IMG_0662.jpg',
  'IMG_0663.jpg',
  'IMG_0664.jpg',
  'IMG_0665.jpg',
  'IMG_0666.jpg',
  'IMG_0667.jpg',
  'IMG_0668.jpg',
  'IMG_0669.jpg',
  'IMG_0670.jpg',
  'IMG_0671.jpg',
]])
@endsection
