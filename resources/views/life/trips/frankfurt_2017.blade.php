@extends('life.trips.base')

@section('content')
@ru
  <p>Самого Франкфурта в этот раз не будет, зато будет путь до него и после него.</p>
@endru

@ru
  <p>Дорога без ограничений скорости — это когда едешь 170 км/с, а тебя резво опережают слева.</p>
@endru
<livewire:youtube title="Germany Autobahn #3, July 2017" v="5sGo7R2KHYo"/>
<livewire:youtube title="Germany Autobahn #4, July 2017" v="4EwN_xXV9oI"/>

@ru
  <p>По необъяснимой причине Гугл повел из Дрездена во Франкфурт по пробкам в деревнях на юго-западе, а не по широкому автобану.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2051.jpg',
  'IMG_2095.jpg',
  'IMG_2086.jpg',
  'IMG_2087.jpg',
  'IMG_2090.jpg',
]])

@ru
  <p>Домики и участки в деревнях.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2062.jpg',
  'IMG_2063.jpg',
  'IMG_2083.jpg',
  'IMG_2088.jpg',
  'IMG_2089.jpg',
  'IMG_2094.jpg',
]])

@ru
  <p>Бензин дороже на трассе, нежели в городах. Стоит заправляться во время ночлега.</p>
@endru

@ru
  <p>Дорога.</p>
@en
  <p>Road.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2064.jpg',
  'IMG_2067.jpg',
  'IMG_2069.jpg',
  'IMG_2070.jpg',
  'IMG_2074.jpg',
  'IMG_2084.jpg',
  'IMG_2098.jpg',
  'IMG_2101.jpg',
  'IMG_2102.jpg',
  'IMG_2103.jpg',
]])

@ru
  <p>Смена языка радио — верный признак въезда в новую страну.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2079.jpg'])

@ru
  <p>Через небольшие поселения проезжать красиво, но следует быть готовым к радостям узкой дороги — заторам.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2081.jpg'])

@ru
  <p>Проветриваемся.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2082.jpg'])

@ru
  <p>По сторонам поля.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2085.jpg'])

@ru
  <p>Солнечные панели вдоль дороги.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2104.jpg'])

@ru
  <p>Автоматическая чистка крышки унитаза в туалете на заправке.</p>
@endru
<livewire:youtube title="Germany Gas Station Toilet, July 2017" v="0BZmyDOdbcQ"/>

@ru
  <p>Неподалеку от заправки место для отдыха. Особенно популярно у дальнобойщиков.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_2107.jpg'])

@ru
  <p>Продолжение пути на закате.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_2132.jpg',
  'IMG_2131.jpg',
  'IMG_2113.jpg',
  'IMG_2119.jpg',
  'IMG_2124.jpg',
  'IMG_2126.jpg',
  'IMG_2127.jpg',
  'IMG_2133.jpg',
]])

@ru
  <p>Проверяйте на больших расстояниях куда вас ведет навигатор, а то окажется, что коснулись пальцем экрана, а тем временем маршрут-то взял и незаметно перестроился. Так вместо Висбадена мы сначала попали в южный грузовой терминал аэропорта Франкфурта.</p>
@endru
@endsection
