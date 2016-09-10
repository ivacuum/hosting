@extends('life.trips.base')

@section('content')
@ru
  <p>Вена — город громадных улиц и площадей.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_2201.jpg',
  'IMG_2200.jpg',
  'IMG_2202.jpg',
  'IMG_2209.jpg',
  'IMG_2198.jpg',
]])

@ru
  <p>И не только.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_2193.jpg'])

@ru
  <p>Часто встречаются парки.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_2192.jpg',
  'IMG_2196.jpg',
  'IMG_2218.jpg',
  'IMG_2217.jpg',
]])

@ru
  <p>Приятно затеряться среди красивых зданий.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_2208.jpg',
  'IMG_2206.jpg',
  'IMG_2203.jpg',
  'IMG_2229.jpg',
]])

@ru
  <p>Улица сотен магазинов.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_2204.jpg',
  'IMG_2207.jpg',
]])

@ru
  <p>Дунайский канал.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_2210.jpg'])

@ru
  <p>Автобусная остановка. Карманы на них не делают — автобус на узкой дороге останавливает все попутное направление, зато потом сразу мчится вперед, а не ждет, пока ему уступят дорогу при выезде. Да и садиться пассажиру удобнее без кармана — транспорт четко к бордюру подъезжает.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_2205.jpg'])

@ru
  <p>Карманы делают для парковок.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_2212.jpg',
  'IMG_2216.jpg',
]])

@ru
  <p>Бросающаяся в глаза форма урны.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_2211.jpg'])

@ru
  <p>Пепельница на автовокзале.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_2238.jpg'])

@ru
  <p>Снаружи видны все перемещения между этажами дома.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_2222.jpg'])

@ru
  <p>Вена стремится стать солнечным городком.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_2224.jpg'])

@ru
  <p>Улочки. Да-да, вспоминая громадные площади и проспекты.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_2215.jpg',
  'IMG_2219.jpg',
  'IMG_2220.jpg',
]])

@ru
  <p>Дороги.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_2190.jpg',
  'IMG_2191.jpg',
  'IMG_2228.jpg',
]])

@ru
  <p>На разметку не скупятся.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_2221.jpg',
  'IMG_2214.jpg',
]])

@ru
  <p>Деловой центр.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_2226.jpg'])

@ru
  <p>Стемнело.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_2230.jpg',
  'IMG_2231.jpg',
  'IMG_2232.jpg',
  'IMG_2233.jpg',
  'IMG_2234.jpg',
]])

@ru
  <p>Наступление Рождества привело к закрытию практически всего и вся, даже продуктов в супермаркете не купить. Самый настоящий семейный праздник. Если заранее не затариться на неделю вперед, то придется тяжеловато.</p>
@endlang
@endsection
