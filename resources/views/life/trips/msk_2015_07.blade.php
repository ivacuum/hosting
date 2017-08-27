@extends('life.trips.base')

@section('content')
@ru
  <p>В поисках магазина с наушниками занесло на восток столицы в район Новогиреево. Несколько раз встречал людей с самокатами — удобно, можно и в метро с ними проехать.</p>
@endlang
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_1661.jpg',
  'IMG_1663.jpg',
]])

@ru
  <p>В центре Москвы все чаще можно встретить классные пешеходные зоны.</p>
@en
  <p>In the center of Moscow one could find great pedestrian zones much more often.</p>
@endlang
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_1665.jpg',
  'IMG_1667.jpg',
  'IMG_1668.jpg',
  'IMG_1670.jpg',
  'IMG_1671.jpg',
  'IMG_1674.jpg',
]])

@ru
  <p>Крайне выгодно пользоваться общественным транспортом с <a class="link" href="http://troika.mos.ru/">картой Тройка</a>. Также в центре постоянно попадается <a class="link" href="http://velobike.ru/">велопрокат</a>, к которому можно привязать Тройку для удобства оплаты.</p>
  <p>Дрэг-рейсинг на Тверской.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_1675.jpg'])

@ru
  <p>Время в столице летит неумолимо — посещение нескольких точек в разных частях города растягивается на целый день. В лучшем случае.</p>
  <p>Вечер закончился <a class="link" href="dreamtheater.2015">концертом</a> группы Dream Theater.</p>
@endlang
@endsection
