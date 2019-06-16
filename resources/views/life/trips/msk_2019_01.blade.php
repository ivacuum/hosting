@extends('life.trips.base')

@section('content')
@ru
  <p>Открытый каток в парке Горького. Можно заранее обзавестись электронными билетами и даже оплатить прокат. Код из билета затем понадобится у турникета.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_7229.jpg',
  'IMG_7240.jpg',
  'IMG_7243.jpg',
  'IMG_7244.jpg',
  'IMG_7246.jpg',
]])

@ru
  <p>Станция проката коньков. Личные вещи тоже можно оставить, чтобы свободно покататься. Прокат можно отдельно оплатить в специальном терминале в этой же комнате.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_7259.jpg'])

@ru
  <p>Коньки на любой размер.</p>
@en
  <p>Skates of any size.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_7258.jpg'])

@ru
  <p>Поручни в метро удобны для вешалок с одеждой.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_7262.jpg'])

@ru
  <p>Новогодние конструкции напротив Киевского вокзала.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_7266.jpg',
  'IMG_7264.jpg',
]])
@endsection
