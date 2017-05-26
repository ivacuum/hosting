@extends('life.trips.base')

@section('content')
@ru
  <p>Рынок снесли. Открылось пространство для закатов.</p>
@en
  <p>The market was closed. There is a space for sunsets now.</p>
@endlang
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3677.jpg',
  'IMG_3678.jpg',
]])
@endsection
