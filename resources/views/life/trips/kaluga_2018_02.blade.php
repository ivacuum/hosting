@extends('life.trips.base')

@section('content')
@ru
  <p>Зима удалась. Столько снега давно не было.</p>
@en
  <p>Winter was a blast. It's been a while since there was so much snow.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_5858.jpg',
  'IMG_5862.jpg',
  'IMG_5857.jpg',
  'IMG_5859.jpg',
  'IMG_5860.jpg',
  'IMG_5861.jpg',
]])

@ru
  <p>Привет <a class="link" href="countries/china">Китаю</a>.</p>
@en
  <p>Shoutout to <a class="link" href="countries/china">China</a>.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_5864.jpg'])
@endsection
