@extends('life.trips.base')

@section('content')
@ru
  <p>Дорога до Мишкольца через национальный парк с серпантинами.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2799.jpg',
  'IMG_2807.jpg',
  'IMG_2815.jpg',
  'IMG_2819.jpg',
]])

@ru
  <p>Прибыли. Городская навигация.</p>
@en
  <p>We have arrived. City navigation.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2824.jpg'])

@ru
  <p>Городская среда.</p>
@en
  <p>Urban space.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2825.jpg',
  'IMG_2829.jpg',
]])

@ru
  <p>Карта центра города. По соседству велодорожка.</p>
@en
  <p>City center map. Cycle lane right next to it.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2832.jpg'])

@ru
  <p>Пешеходно-трамвайная улица.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2833.jpg'])

@ru
  <p>Люк.</p>
@en
  <p>Manhole.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2835.jpg'])

@ru
  <p>Табло с расписанием транспорта непросто четко запечатлеть.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2838.jpg'])

@ru
  <p>Проще сфотографировать экран терминала.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2840.jpg'])

@ru
  <p>Улицы.</p>
@en
  <p>Streets.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2842.jpg',
  'IMG_2846.jpg',
  'IMG_2852.jpg',
]])

@ru
  <p>Фонтан.</p>
@en
  <p>Fountain.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2853.jpg'])

@ru
  <p>Вход в здание почты.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2855.jpg'])

@ru
  <p>Проезд сквозь здание.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2857.jpg'])

@ru
  <p>Указательный палец.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2859.jpg'])

@ru
  <p>Паб ожидания.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2864.jpg'])

@ru
  <p>Дорожные пейзажи по возвращении в Будапешт на закате.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2866.jpg',
  'IMG_2889.jpg',
  'IMG_2901.jpg',
  'IMG_2910.jpg',
  'IMG_2915.jpg',
  'IMG_2922.jpg',
  'IMG_2923.jpg',
  'IMG_2925.jpg',
  'IMG_2926.jpg',
]])
@endsection
