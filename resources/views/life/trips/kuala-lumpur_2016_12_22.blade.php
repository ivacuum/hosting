@extends('life.trips.base')

@section('content')
@ru
  <p>Камера хранения в аэропорту перед открытием ячейки делает фото лица и снимает отпечаток пальца. Забрать вещи можно после повторного фотографирования.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3098.jpg'])

@ru
  <p>Указатели переведены на японский.</p>
@en
  <p>Navigation translated into Japanese.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3099.jpg'])

@ru
  <p>Вход в аэропорт.</p>
@en
  <p>Entrance to the airport.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3101.jpg'])

@ru
  <p>Красные такси.</p>
@en
  <p>Red taxies.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3126.jpg'])

@ru
  <p>Стоит разок прокатиться на междугороднем автобусе заграницей, так сразу запоминаешь, что их зовут коуч (coach).</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3103.jpg'])

@ru
  <p>Улицы.</p>
@en
  <p>Streets.</p>
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
@en
  <p>Entrance to the park.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3114.jpg'])

@ru
  <p>Набережная.</p>
@en
  <p>Embankment.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3116.jpg',
  'IMG_3118.jpg',
]])

@ru
  <p>Чух-чух. Пополнение коллекции поездов.</p>
@en
  <p>Chuh-chuh. Expanding the trains collection.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3127.jpg'])

@ru
  <p>Желтый арбуз.</p>
@en
  <p>Yellow watermelon.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3129.jpg'])

@ru
  <p>Самолетики. Один из таких везет в сторону дома.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3133.jpg'])
@endsection
