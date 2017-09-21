@extends('life.trips.base')

@section('content')
@ru
  <p>Дорога в Роттердам в непогоду и на закате дня. Под фильм Залечь на дно в Брюгге, дабы сравнить увиденное.</p>
@endru
<youtube title="Rotterdam Road #1, July 2017" v="l0F0SjZL0LM"></youtube>
<youtube title="Rotterdam Road #2, July 2017" v="iNxYdSwig6E"></youtube>
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2450.jpg',
  'IMG_2452.jpg',
  'IMG_2456.jpg',
  'IMG_2466.jpg',
  'IMG_2468.jpg',
  'IMG_2470.jpg',
]])

@ru
  <p>Парковка у отеля. Есть смысл при бронировании обращать внимание на наличие бесплатной парковки — неплохая экономия денег и времени выйдет. Здесь была бесплатная парковка ночью для всех, но с утра счетчик начинал тикать. Терминал находился не особо близко, плюс он не принимал российские банковские карты.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2479.jpg'])

@ru
  <p>Велосипеды не стесняются ночью прямо на улице.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2485.jpg'])

@ru
  <p>Ночной указатель номера дома.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2498.jpg',
  'IMG_2500.jpg',
]])

@ru
  <p>Утром свободных парковочных мест стало куда больше.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2505.jpg'])

@ru
  <p>Завтрак в отеле.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2503.jpg'])

@ru
  <p>Можно его перенести на улицу.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2502.jpg'])

@ru
  <p>Велопарковки пользуются не меньшим спросом, нежели автомобильные.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2501.jpg'])

@ru
  <p>Путь по городу.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2613.jpg',
  'IMG_2520.jpg',
  'IMG_2516.jpg',
  'IMG_2510.jpg',
]])

@ru
  <p>Мосты.</p>
@en
  <p>Bridges.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2604.jpg',
  'IMG_2605.jpg',
]])

@ru
  <p>Бензин по полтора евро за литр.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2606.jpg'])

@ru
  <p>Рядом с колонкой доступна оплата картой без контакта с человеком.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2609.jpg'])

@ru
  <p>Подъезд.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2610.jpg'])

@ru
  <p>Набережная.</p>
@en
  <p>Embankment.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2611.jpg'])

@ru
  <p>Пешеходная зона.</p>
@en
  <p>Pedestrian zone.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2615.jpg',
  'IMG_2629.jpg',
]])

@ru
  <p>Почтовые ящики.</p>
@en
  <p>Postboxes.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2616.jpg'])

@ru
  <p>Сырный магазин.</p>
@en
  <p>Cheese shop.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2617.jpg'])

@ru
  <p>Трамвай.</p>
@en
  <p>Tram.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2621.jpg'])

@ru
  <p>В магазине фигурки и локации из вселенной Вархаммер 40000.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2625.jpg'])

@ru
  <p>Узкая машина подглядывает из-за угла. Остаемся начеку.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2627.jpg'])
@endsection
