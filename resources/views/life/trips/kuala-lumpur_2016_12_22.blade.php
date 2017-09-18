@extends('life.trips.base')

@section('content')
@ru
  <p>Камера хранения в аэропорту перед открытием ячейки делает фото лица и снимает отпечаток пальца. Забрать вещи можно после повторного фотографирования.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3098.jpg'])

@ru
  <p>Указатели переведены на японский.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3099.jpg'])

@ru
  <p>Вход в аэропорт.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3101.jpg'])

@ru
  <p>Красные такси.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3126.jpg'])

@ru
  <p>Стоит разок прокатиться на междугороднем автобусе заграницей, так сразу запоминаешь, что их зовут коуч (coach).</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3103.jpg'])

@ru
  <p>Улицы.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3102.jpg',
  'IMG_3107.jpg',
  'IMG_3108.jpg',
  'IMG_3113.jpg',
  'IMG_3125.jpg',
]])

@ru
  <p>Странной формы поручни.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3109.jpg'])

@ru
  <p>Стоунхендж наверху?</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3112.jpg'])

@ru
  <p>Вход в парк.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3114.jpg'])

@ru
  <p>Набережная.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3116.jpg',
  'IMG_3118.jpg',
]])

@ru
  <p>Чух-чух. Пополнение коллекции поездов.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3127.jpg'])

@ru
  <p>Желтый арбуз.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3129.jpg'])

@ru
  <p>Самолетики. Один из таких везет в сторону дома.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3133.jpg'])
@endsection
