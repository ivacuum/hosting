@extends('life.trips.base')

@section('content')
<p>Город замело снегом.</p>
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2656.jpg',
  'IMG_2658.jpg',
  'IMG_2659.jpg',
  'IMG_2669.jpg',
]])
@endsection
