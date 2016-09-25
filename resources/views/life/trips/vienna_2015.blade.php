@extends('life.trips.base')

@section('content')
@ru
  <p>Вена — город громадных улиц и площадей.</p>
@en
  <p>Vienna is a city of giant streets and squares.</p>
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
@en
  <p>And not only of that.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_2193.jpg'])

@ru
  <p>Часто встречаются парки.</p>
@en
  <p>There are a lot of parks.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_2192.jpg',
  'IMG_2196.jpg',
  'IMG_2218.jpg',
  'IMG_2217.jpg',
]])

@ru
  <p>Приятно затеряться среди красивых зданий.</p>
@en
  <p>It's a pleasure to get lost among beautiful buildings.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_2208.jpg',
  'IMG_2206.jpg',
  'IMG_2203.jpg',
  'IMG_2229.jpg',
]])

@ru
  <p>Улица сотен магазинов.</p>
@en
  <p>Hundreds shops street.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_2204.jpg',
  'IMG_2207.jpg',
]])

@ru
  <p>Дунайский канал.</p>
@en
  <p>Donaukanal.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_2210.jpg'])

@ru
  <p>Автобусная остановка. Карманы на них не делают — автобус на узкой дороге останавливает все попутное направление, зато потом сразу мчится вперед, а не ждет, пока ему уступят дорогу при выезде. Да и садиться пассажиру удобнее без кармана — транспорт четко к бордюру подъезжает.</p>
@en
  <p>Bus stop. There is no pocket for it. Bus stops the whole traffic lane, while boarding and landing passengers, so there is no need for it to wait when someone give way to start movement — bus can go immediately. Lack of pocket is also good for passengers, bus is much closer to the edge of the stop, so it's easier for them to board or land.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_2205.jpg'])

@ru
  <p>Карманы делают для парковок.</p>
@en
  <p>Pockets are for parking instead.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_2212.jpg',
  'IMG_2216.jpg',
]])

@ru
  <p>Бросающаяся в глаза форма урны.</p>
@en
  <p>Conspicuous form of bin.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_2211.jpg'])

@ru
  <p>Пепельница на автовокзале.</p>
@en
  <p>Ashtray at the bus station.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_2238.jpg'])

@ru
  <p>Снаружи видны все перемещения между этажами дома.</p>
@en
  <p>All the movements between the floors can been seen from outside.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_2222.jpg'])

@ru
  <p>Вена стремится стать солнечным городком.</p>
@en
  <p>Vienna tends to become a solar city.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_2224.jpg'])

@ru
  <p>Улочки. Да-да, вспоминая громадные площади и проспекты.</p>
@en
  <p>Tiny streets. Yeah, in comparison to giant squares and avenues.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_2215.jpg',
  'IMG_2219.jpg',
  'IMG_2220.jpg',
]])

@ru
  <p>Дороги.</p>
@en
  <p>Roads.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_2190.jpg',
  'IMG_2191.jpg',
  'IMG_2228.jpg',
]])

@ru
  <p>На разметку не скупятся.</p>
@en
  <p>Generous road marking.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_2221.jpg',
  'IMG_2214.jpg',
]])

@ru
  <p>Деловой центр.</p>
@en
  <p>Downtown.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_2226.jpg'])

@ru
  <p>Темнеет.</p>
@en
  <p>It's getting dark.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_2230.jpg',
  'IMG_2231.jpg',
  'IMG_2232.jpg',
  'IMG_2233.jpg',
  'IMG_2234.jpg',
]])

@ru
  <p>Наступление Рождества ведет к закрытию практически всего и вся, даже продуктов в супермаркете не купить. Самый настоящий семейный праздник. Если заранее не затариться на неделю вперед, то придется тяжеловато.</p>
@en
  <p>Christmas leads to short working hours on December 24th for pretty much everything, even supermarkets are getting closed at 4pm, which is rare in <a class="link" href="/en/life/countries/russia">Russia</a>. Truly family holiday. It's better to shop all the goods in advance.</p>
@endlang
@endsection
