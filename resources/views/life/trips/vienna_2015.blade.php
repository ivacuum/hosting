@extends('life.trips.base')

@section('content')
<p lang="ru">Вена — город громадных улиц и площадей.</p>
@include('tpl.fotorama', ['pics' => [
  'IMG_2201.jpg',
  'IMG_2200.jpg',
  'IMG_2202.jpg',
  'IMG_2209.jpg',
  'IMG_2198.jpg',
]])

<p lang="ru">И не только.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_2193.jpg'])

<p lang="ru">Часто встречаются парки.</p>
@include('tpl.fotorama', ['pics' => [
  'IMG_2192.jpg',
  'IMG_2196.jpg',
  'IMG_2218.jpg',
  'IMG_2217.jpg',
]])

<p lang="ru">Приятно затеряться среди красивых зданий.</p>
@include('tpl.fotorama', ['pics' => [
  'IMG_2208.jpg',
  'IMG_2206.jpg',
  'IMG_2203.jpg',
  'IMG_2229.jpg',
]])

<p lang="ru">Улица сотен магазинов.</p>
@include('tpl.fotorama', ['pics' => [
  'IMG_2204.jpg',
  'IMG_2207.jpg',
]])

<p lang="ru">Дунайский канал.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_2210.jpg'])

<p lang="ru">Автобусная остановка. Карманы на них не делают — автобус на узкой дороге останавливает все попутное направление, зато потом сразу мчится вперед, а не ждет, пока ему уступят дорогу при выезде. Да и садиться пассажиру удобнее без кармана — транспорт четко к бордюру подъезжает.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_2205.jpg'])

<p lang="ru">Карманы делают для парковок.</p>
@include('tpl.fotorama', ['pics' => [
  'IMG_2212.jpg',
  'IMG_2216.jpg',
]])

<p lang="ru">Бросающаяся в глаза форма урны.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_2211.jpg'])

<p lang="ru">Пепельница на автовокзале.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_2238.jpg'])

<p lang="ru">Снаружи видны все перемещения между этажами дома.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_2222.jpg'])

<p lang="ru">Вена стремится стать солнечным городком.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_2224.jpg'])

<p lang="ru">Улочки. Да-да, вспоминая громадные площади и проспекты.</p>
@include('tpl.fotorama', ['pics' => [
  'IMG_2215.jpg',
  'IMG_2219.jpg',
  'IMG_2220.jpg',
]])

<p lang="ru">Дороги.</p>
@include('tpl.fotorama', ['pics' => [
  'IMG_2190.jpg',
  'IMG_2191.jpg',
  'IMG_2228.jpg',
]])

<p lang="ru">На разметку не скупятся.</p>
@include('tpl.fotorama', ['pics' => [
  'IMG_2221.jpg',
  'IMG_2214.jpg',
]])

<p lang="ru">Деловой центр.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_2226.jpg'])

<p lang="ru">Стемнело.</p>
@include('tpl.fotorama', ['pics' => [
  'IMG_2230.jpg',
  'IMG_2231.jpg',
  'IMG_2232.jpg',
  'IMG_2233.jpg',
  'IMG_2234.jpg',
]])

<p lang="ru">Наступление Рождества привело к закрытию практически всего и вся, даже продуктов в супермаркете не купить. Самый настоящий семейный праздник. Если заранее не затариться на неделю вперед, то придется тяжеловато.</p>
@endsection
