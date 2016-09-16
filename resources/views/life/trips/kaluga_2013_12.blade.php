@extends('life.trips.base')

@section('content')
@ru
  <p>Сходу и не скажешь, что через пару дней наступит новый год.</p>
@en
  <p>The weather doesn't look like it's January 1 in a few days.</p>
@endlang
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0339.jpg',
  'IMG_0340.jpg',
]])
@endsection
