@extends('life.trips.base')

@section('content')
@ru
  <p>День.</p>
@en
  <p>Afternoon.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0115.jpg'])

@ru
  <p>Вечер. Место пересечения двух параллельных улиц: Московской и Ленина.</p>
@en
  <p>Evening. The place where two parallel streets — Moskovskaya and Lenin — intersect.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0116.jpg'])
@endsection
