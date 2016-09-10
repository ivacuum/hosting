@extends('life.trips.base')

@section('content')
@ru
  <p>Город замело снегом.</p>
@en
  <p>City is covered with snow.</p>
@endlang
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2656.jpg',
  'IMG_2658.jpg',
  'IMG_2659.jpg',
  'IMG_2669.jpg',
]])
@endsection
