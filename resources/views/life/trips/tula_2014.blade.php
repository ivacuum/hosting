@extends('life.trips.base')

@section('content')
@ru
  <p>Исследование города на велосипеде.</p>
@en
  <p>City exploration on the bike.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0630.jpg'])

@ru
  <p>Внезапно тупик у железной дороги.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0631.jpg'])

@ru
  <p>Местами кучкуются деревянные дома.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0632.jpg'])

@ru
  <p>В Туле очень много детских площадок во дворах. Вдобавок большинство дворов изобилует деревьями и теньком — детям в кайф проводить дни напролет на улице.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0638.jpg',
  'IMG_0646.jpg',
]])

@ru
  <p>Сам город очень рельефный.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0642.jpg',
  'IMG_0643.jpg',
]])

@ru
  <p>Трамвайным путям не позавидуешь.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0649.jpg',
  'IMG_0650.jpg',
  'IMG_0651.jpg',
  'IMG_0652.jpg',
  'IMG_0673.jpg',
  'IMG_0674.jpg',
]])

@ru
  <p>Да и пешеходу тоже. Крайне редко встречаются места с тротуарной плиткой — в основном в центре.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0676.jpg',
  'IMG_0655.jpg',
  'IMG_0657.jpg',
  'IMG_0661.jpg',
  'IMG_0682.jpg',
  'IMG_0664.jpg',
]])

@ru
  <p>Река Упа.</p>
@en
  <p>Upa river.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0680.jpg'])

@ru
  <p>Укатив черт знает куда на восток Тулы, наткнулся на затяжной спуск вдоль гаражей по нелюбимой щебенке (даже по песку лучше ехать). После приятного спуска на велосипеде всегда следует тяжелый подъем. В этот раз это почему-то не смущало. В определенный момент слева обнаружился въезд на большую открытую зону, а там трасса для мотокросса.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0666.jpg',
  'IMG_0668.jpg',
  'IMG_0669.jpg',
  'IMG_0671.jpg',
]])

@ru
  <p>Дороги.</p>
@en
  <p>Roads.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0635.jpg',
  'IMG_0640.jpg',
  'IMG_0644.jpg',
  'IMG_0659.jpg',
  'IMG_0662.jpg',
  'IMG_0683.jpg',
]])

@ru
  <p>Круг по городу сделан.</p>
@en
  <p>Trip around the city is done.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0689.jpg'])
@endsection
