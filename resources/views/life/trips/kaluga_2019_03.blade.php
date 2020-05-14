@extends('life.trips.base')

@section('content')
@ru
  <p>Грязные сугробы отжимают парковочные места.</p>
@en
  <p>Muddy snowdrifts occupy parking spaces.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_7385.jpg',
  'IMG_7386.jpg',
]])
@endsection
