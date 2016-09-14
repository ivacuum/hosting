@extends('life.trips.base')

@section('content')
@ru
  <p>Первый же встретившийся дорожный знак в Германии — ограничение скорости 130 км/ч. И ветряные мельницы вдали.</p>
@en
  <p>The first road sign I saw in Germany is 130 kph (80 mph) speed limit. And windmills in the distance.</p>
@endlang

@ru
  <p>Цвет велосипедиста в Германии — красный, пешехода — серый.</p>
@en
  <p>German cyclist color is red, and pedestrian is gray.</p>
@de
  <p>Die Farbe des Radfahrers in Deutschland ist rot und des Fußgängers ist grau.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_2075.jpg',
  'IMG_2073.jpg',
  'IMG_2149.jpg',
]])

@ru
  <p>На малополосных дорогах не всегда можно встретить светофор или пешеходный переход — автомобилисты и так пропускают. Спокойствие на дорогах приятно поражает — за весь день прогулки лишь к вечеру услышал, чтобы водитель кому-то посигналил, причем в том случае сигнал предотвратил аварию.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_2115.jpg',
  'IMG_2076.jpg',
]])

@ru
  <p>Зебр вообще нет в привычном русскому понимании. Тут отмечают границы перехода, порой эти границы разные для велосипедистов и пешеходов.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_2123.jpg',
  'IMG_2132.jpg',
]])

@ru
  <p>Пешеход может запросить зеленый для перехода дороги, но не всегда это самый эффективный способ. Фазы достаточно долгие, движение в городе не такое быстрое. Если попалось место с малым количеством машин, то проще перейти после потока на красный, чем ждать минуту, поглядывая на пустую дорогу.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_2133.jpg'])

<a name="tram_light"></a>
@ru
  <p>Светофор для перехода трамвайных путей. Два огня означают, что вот-вот пронесется трамвай. При одном он еще достаточно далеко, а при выключенных огнях можно переходить вовсе без опаски. Отдельно стоит заметить ограждения, не позволяющие пройти насквозь прямо. Так и представляю залипшего в мобилу человека, который утыкается в ограду.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_2146.jpg'])

@ru
  <p>На улице +12&deg;C, какие-то дома красят, а этот сносят.</p>
@en
  <p>It's +12&deg;C (53&deg;F), some houses are being painted, but this one is being demolished.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_2113.jpg'])

@ru
  <p>Терминал оплаты автомобильной парковки.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_2080.jpg'])

@ru
  <p>Зарядка для электроавтомобилей неподалеку от главного вокзала.</p>
@en
  <p>Place near the main station to charge an electric vehicle.</p>
@de
  <p>Laden für die elektrisches Autos ist nicht weit vom Hauptbahnhof.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_2155.jpg'])

@ru
  <p>На носу Рождество.</p>
@en
  <p>Christmas is coming.</p>
@de
  <p>Bald ist Weihnachten.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_2142.jpg',
  'IMG_2086.jpg',
]])

@ru
  <p>Устремив на стройке взгляд ввысь, заметил, что рабочие умудрились затащить елку на один из башенных кранов. Праздник даже на высоте.</p>
  <p>Исторический центр.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_2088.jpg',
  'IMG_2092.jpg',
  'IMG_2093.jpg',
  'IMG_2094.jpg',
  'IMG_2095.jpg',
]])

@ru
  <p>Проходя по мостам через реку Эльбу.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_2100.jpg',
  'IMG_2126.jpg',
  'IMG_2127.jpg',
  'IMG_2128.jpg',
]])

@ru
  <p>За день не попалось ни одного бесплатного вай-фая, даже в Макдоналдсе. Одни платные хотспоты Дойче телекома за 5 евро в сутки. При оплате банковской картой бывают ограничения по минимальной сумме платежа, мелкая наличка не будет лишней. Вообще монеты крайне ценны в Европе — именно они являются основным способом оплаты общественного транспорта.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_2148.jpg'])

@ru
  <p>Застекленные балконы — редкость.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_2079.jpg',
  'IMG_2081.jpg',
  'IMG_2150.jpg',
  'IMG_2151.jpg',
  'IMG_2104.jpg',
]])

@ru
  <p>В городе очень много велосипедистов и велопарковок. Можно встретить дома, где у каждого подъезда будет по небольшой парковке.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_2083.jpg',
  'IMG_2084.jpg',
  'IMG_2118.jpg',
  'IMG_2136.jpg',
]])

@ru
  <p>Два железнодорожных вокзала снаружи.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_2071.jpg',
  'IMG_2117.jpg',
]])

@ru
  <p>Крутой низкопольный трамвай.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_2111.jpg'])

@ru
  <p>Жилища студентов. Ночью субъективно крайне слабое освещение на улицах, причем свет используется теплый желтый.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_2153.jpg'])

@ru
  <p>Подъезды, однако, светлые. Более того — в части домов в этом районе с улицы видно лестничную клетку. И видно, что на свет включается автоматически по ходу движения этаж за этажом.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_2154.jpg'])

@ru
  <p>Бесчетное количество мест для прогулок.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_2109.jpg',
  'IMG_2110.jpg',
  'IMG_2112.jpg',
  'IMG_2114.jpg',
  'IMG_2116.jpg',
  'IMG_2122.jpg',
  'IMG_2125.jpg',
  'IMG_2129.jpg',
  'IMG_2144.jpg',
]])

@ru
  <p>В целом Дрезден произвел впечатление города будущего. В плане, что нам к такой красоте стремиться и стремиться, причем немцы за это время еще дальше от нас оторвутся.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_2087.jpg',
  'IMG_2082.jpg',
  'IMG_2085.jpg',
  'IMG_2105.jpg',
  'IMG_2106.jpg',
  'IMG_2107.jpg',
  'IMG_2130.jpg',
  'IMG_2139.jpg',
  'IMG_2140.jpg',
  'IMG_2141.jpg',
  'IMG_2143.jpg',
  'IMG_2145.jpg',
]])

@ru
  <p>Бонус: подробнее <a class="link" href="http://ilyabirman.ru/meanwhile/all/deutsche-autobahnen/">об автобанах</a> в рассказе Ильи Бирмана.</p>
@endlang
@endsection
