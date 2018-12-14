@extends('life.trips.base')

@section('content')
@ru
  <p>Метро растет.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_5724.jpg'])

@ru
  <p>Город украшается.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_5728.jpg'])

@ru
  <p>Объявления в подъезде клеятся.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_5740.jpg'])

@ru
  <p>Помойки облагораживаются и навесом защищаются.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_5742.jpg',
  'IMG_5744.jpg',
]])

@ru
  <p>Люди гуляют.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_5747.jpg'])

@ru
  <p>Палатки устанавливаются.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_5749.jpg'])

@ru
  <p>Плата за проезд картой принимается.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_5753.jpg'])

@ru
  <p><a class="link" href="shanghai.2017#metro">Шанхай</a> по оформлению метро вспоминается.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_5755.jpg'])

@ru
  <p>Строительные леса у дома уж три года держатся.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_5759.jpg'])

@ru
  <p>Терминал конкурентным преимуществом хвастается.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_5761.jpg'])

@ru
  <p>Подходы к аэропорту коммунальщиками раскатываются.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_5764.jpg'])
@endsection
