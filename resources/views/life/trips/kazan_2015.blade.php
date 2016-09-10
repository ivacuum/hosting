@extends('life.trips.base')

@section('content')
@ru
  <p>Перелет в Казань не только оказался самым коротким из всех моих перелетов, но еще и самым комфортным. До этого мой топ возглавлял Боинг 777, но теперь и Сухой Суперджет занял достойное место рядом. На первое место все же его не поставишь из-за разных дистанций — приятный час на Сухом и мимолетные 6 часов на Боинге помещают самолеты в разные весовые категории.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0411.jpg'])

@ru
  <p>Дождь попросил несколько часов переждать дома.</p>
@en
  <p>The rain asked to wait for a few hours at home.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_1571.jpg',
  'IMG_1573.jpg',
]])

@ru
  <p>В центре Казани много пешеходных улиц и мест для прогулок.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_1614.jpg',
  'IMG_1615.jpg',
  'IMG_1616.jpg',
  'IMG_1602.jpg',
  'IMG_1578.jpg',
  'IMG_1580.jpg',
  'IMG_1605.jpg',
]])

@ru
  <p>Окрестности Кремля.</p>
@en
  <p>Around the Kremlin.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_1577.jpg',
  'IMG_1581.jpg',
  'IMG_1582.jpg',
  'IMG_1593.jpg',
]])

@ru
  <p>Вид на Кремль с другой стороны реки Казанки.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_1627.jpg'])

<a name="palace"></a>
@ru
  <p>Дворец земледельцев и соседние дома.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'SAM_0678.jpg',
  'SAM_0687.jpg',
]])

{{--
<p>Мечеть.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_1591.jpg'])
--}}

@ru
  <p>Дороги широкие: часто полосы по три-четыре в каждую сторону, нередки трамвайные пути посередине.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_1611.jpg',
  'IMG_1599.jpg',
  'IMG_1600.jpg',
  'IMG_1603.jpg',
  'IMG_1604.jpg',
  'IMG_1606.jpg',
]])

@ru
  <p>Метро всего одна ветка, за 20 @include('tpl.rub') можно доехать до противоположной части города. Народу им пользуется мало, все станции темные. В данный момент большие автобусы и троллейбусы выигрывают в плане перемещения по городу за счет движения по выделенным полосам и отображения местоположения в <a class="link" href="https://mobile.yandex.ru/apps/transport/iphone/">Яндекс-транспорте</a>, в котором пока нет только трамвая. Все остановки в общественном транспорте объявляют на трех языках: русском, татарском и английском. Часто выходит так, что автобус уже трогается с остановки, когда еще дело не дошло до английского языка.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_1622.jpg'])

@ru
  <p>Красивая аллея фонтанов. Справа на дороге можно заметить тот самый большой автобус.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_1608.jpg'])

@ru
  <p>В городе несколько набережных: есть длинные, есть покороче. Эта облюбована кафешками, можно покататься на лодке. Она также приглянулась уткам и лебедям.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_1613.jpg'])

@ru
  <p>На следующей набережной здорово кататься на роликах и велосипеде. Неподалеку от моста Миллениум ее еще приводят в порядок, но много километров плотного покрытия в любом случае доступно.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_1636.jpg'])

@ru
  <p>Еще одно классное место для прогулок и катания — ЦПКиО им. Горького. В нем часто встречаются белки.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_1642.jpg',
  'IMG_1641.jpg',
]])

@ru
  <p>Около дома нашлась многоэтажная наземная парковка. До этого их видел только у аэропорта Внуково в Москве.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_1649.jpg'])

@ru
  <p>Четыре дня и три ночи оказались идеальной продолжительностью для поездки. В <a class="link" href="/life/kaliningrad.2015">Калининграде</a> было три дня: в первый прилетели, а на третий уже улетели. Провести два полных дня в городе гораздо лучше, то есть, например, прилететь в пятницу, а улететь обратно в понедельник. Конечно, не для любого места подойдет такая схема, но в этот раз она сработала на отлично.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0280.jpg'])
@endsection
