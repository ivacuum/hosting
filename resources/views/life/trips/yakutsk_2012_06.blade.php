@extends('life.trips.base')

@section('content')
@ru
  <p>Город днем.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2449.jpg'])

@ru
  <p>Закат в половине первого ночи.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2452.jpg'])

@ru
  <p>Ежегодный национальный праздник. Загульная неделя. Несмотря на написание, в простонародье читается эсэх.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2461.jpg'])

@ru
  <p>Лавочка.</p>
@en
  <p>Bench.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2457.jpg'])

@ru
  <p>На территории праздника.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2453.jpg',
  'IMG_2455.jpg',
  'IMG_2456.jpg',
  'IMG_2466.jpg',
  'IMG_2468.jpg',
  'IMG_2469.jpg',
  'IMG_2470.jpg',
  'IMG_2471.jpg',
  'IMG_2472.jpg',
  'IMG_2474.jpg',
  'IMG_2475.jpg',
  'IMG_2476.jpg',
]])

@ru
  <p>Идеальные кандидаты для аватарки.</p>
@en
  <p>Ideal candidates for the profile picture.</p>
@endru
@include('tpl.fotorama-2x', ['w' => 563, 'h' => 750, 'pics' => [
  'IMG_2478.jpg',
  'IMG_2479.jpg',
]])

@ru
  <p>Аэропорт Якутска.</p>
@en
  <p>Yakutsk airport.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2520.jpg'])

@ru
  <p>Облака на подлете к Москве.</p>
@en
  <p>Clouds on my way to Moscow.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2521.jpg',
  'IMG_2522.jpg',
  'IMG_2523.jpg',
  'IMG_2524.jpg',
  'IMG_2525.jpg',
  'IMG_2526.jpg',
  'IMG_2527.jpg',
  'IMG_2528.jpg',
  'IMG_2529.jpg',
  'IMG_2535.jpg',
  'IMG_2538.jpg',
]])
@endsection
