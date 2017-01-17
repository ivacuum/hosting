@extends('life.trips.base')

@section('content')
@ru
  <p>Город, в котором снег — редкий гость.</p>
@endlang
@include('tpl.pic', ['pic' => 'IMG_0076.jpg'])

@ru
  <p>В Калининграде полно мест для прогулок, набережных так и вовсе несколько.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_1446.jpg',
  'IMG_1454.jpg',
  'IMG_1448.jpg',
  'IMG_1455.jpg',
  'IMG_1496.jpg',
  'IMG_1498.jpg',
]])

@ru
  <p>Улицы.</p>
@en
  <p>Streets.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_1502.jpg',
  'IMG_1501.jpg',
  'IMG_1503.jpg',
  'IMG_1504.jpg',
  'IMG_1506.jpg',
]])

@ru
  <p>В поездке впервые опробовал сервис аренды жилья <a href="https://www.airbnb.com/c/spankov1?s=8" class="link">Airbnb</a>. Снимать квартиру с помощью него оказалось сплошным удовольствием — оплата заранее по карте, въезд и выезд занял считанные минуты, связываться с владельцем можно даже через Viber, WhatsApp и прочие подобные сервисы. Рекомендую.</p>
@endlang

@ru
  <p>На Куршскую косу легко попасть, но непросто ее покинуть. Если вы, конечно, не на своей машине. Общественный транспорт отсюда ходит лишь несколько раз в день. По пути обратно на дорогу вообще выбежал кабан из леса, что, впрочем, не помешало водителю продолжить путь.</p>
@endlang
@include('tpl.pic', ['pic' => 'IMG_1469.jpg'])

@ru
  <p>Дюны.</p>
@en
  <p>Dunes.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_1477.jpg',
  'IMG_1474.jpg',
  'IMG_1479.jpg',
]])

@ru
  <p>Балтийское море.</p>
@en
  <p>Baltic sea.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_1489.jpg',
  'IMG_1488.jpg',
  'IMG_1482.jpg',
  'IMG_1484.jpg',
]])

@ru
  <p>У кондукторов и водителей в общественном транспорте ленты билетов с разным номиналом: 10 рублей, 5 и т.п. Отматывают вам столько, сколько вы заплатили за проезд. Одна поездка рублей на 200, и можно мерить талию.</p>
@endlang

@ru
  <p>Неподалеку от японского консульства встретилась мемориальная скамейка.</p>
@endlang
@include('tpl.pic', ['pic' => 'IMG_1508.jpg'])

<a name="house_number"></a>
@ru
  <p>В Калининграде нумеруются подъезды, а не дома. <a href="/life/msk.2014.12#house_number" class="link">Сравните с Москвой</a>. Номер дома лишь подсказывает какие подъезды можно в нем встретить. Нумерация квартир в каждом из них начинается заново с единицы. Поэтому на картах того же Яндекса можно видеть, что дом с картинки ниже <a href="http://maps.yandex.ru/-/CVGCzOK3" class="link">подписан несколько раз</a> — по количеству подъездов.</p>
@endlang
@include('tpl.pic', ['pic' => 'IMG_1505.jpg'])

<a name="trees"></a>
@ru
  <p><a class="pseudo" data-toggle="feedback" data-target=".js-modal-feedback" data-question="Что за очаги листьев на деревьях зимой?">Что за очаги листьев</a> на деревьях зимой?</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_1500.jpg',
  'IMG_1468.jpg',
]])

@ru
  <p>В той же Калуге Луна предстает совершенно иначе — она больше и ярко белая, а в Калининграде маленькая, с мягким желтым ореолом. На снимке же это просто банан, <a href="/life/spb.2014.09#banana" class="link">как в Питере</a>.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_1456.jpg',
  'IMG_1457.jpg',
]])

@ru
  <p>Дороги.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_1447.jpg',
  'IMG_1491.jpg',
  'IMG_1507.jpg',
  'IMG_1510.jpg',
  'IMG_1514.jpg',
  'IMG_1515.jpg',
  'IMG_1516.jpg',
]])

@ru
  <p>К отсутствию снега так привыкаешь, что потом тяжеловато возвращаться в заснеженную Москву. Или это в Калининграде так чисто?.. Ан, нет, показалось.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_1518.jpg',
  'IMG_1511.jpg',
]])
@endsection
