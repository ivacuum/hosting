@extends('life.trips.base')

@section('content')
@ru
  <p>За окном во время поездки на автобусе из Такаямы в Мацумото.</p>
@endru
<youtube title="Matsumoto Bus, April 2017" v="neekGArH7pU"></youtube>
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_7744.jpg',
  'IMG_7746.jpg',
  'IMG_7754.jpg',
  'IMG_7763.jpg',
  'IMG_7771.jpg',
  'IMG_7781.jpg',
  'IMG_7820.jpg',
  'IMG_7832.jpg',
  'IMG_7845.jpg',
]])

@ru
  <p>В горах полно снега.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_7789.jpg'])

@ru
  <p>По пути много тоннелей. При движении по ним в поездах закладывает уши, причем не только в шинкансенах.</p>
@endru
<youtube title="Matsumoto Bus in Tunnel, April 2017" v="87rCmd8QWuk"></youtube>
@include('tpl.pic-2x', ['pic' => 'IMG_7793.jpg'])

@ru
  <p>И даже дамба.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_7806.jpg'])

@ru
  <p>На табло слева цены за проезд от определенных участков пути. Полный путь в 91 км из Такаямы стоит 3 190 иен (около 1650 ₽ на момент поездки).</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_7846.jpg'])

@ru
  <p>Разноцветные люки.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_7850.jpg',
  'IMG_7851.jpg',
]])

@ru
  <p>Около писсуаров крючки для зонтов.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_7887.jpg'])

@ru
  <p>Цветы перед домом.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_7860.jpg'])

@ru
  <p>Потрясающий столб освещения.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_7861.jpg'])

@ru
  <p>Речка.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_7859.jpg'])

@ru
  <p>Улицы.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_7847.jpg',
  'IMG_7848.jpg',
  'IMG_7849.jpg',
  'IMG_7852.jpg',
  'IMG_7855.jpg',
  'IMG_7885.jpg',
]])

@ru
  <p>Дороги.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_7853.jpg',
  'IMG_7862.jpg',
  'IMG_7866.jpg',
]])

@ru
  <p>Лавочка.</p>
@en
  <p>Bench.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_7868.jpg'])

@ru
  <p>Парк — эвакуационная точка при чрезвычайных ситуациях.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_7870.jpg'])

@ru
  <p>Сам парк прекрасен.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_7881.jpg'])

@ru
  <p>Черный замок, красный мост, горы на фоне. Красота!</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_7884.jpg'])

@ru
  <p>Здесь остановится второй вагон восьми- и десятивагонных составов.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_7890.jpg'])

@ru
  <p>Железнодорожная станция. На немецкий манер платформы внизу, а переход с помощью эскалатора по верху.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_7894.jpg',
  'IMG_7889.jpg',
  'IMG_7892.jpg',
]])
@endsection
