@extends('life.trips.base')

@section('content')
<p>Привет, Берлин!</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0694.jpg'])

<p>Нам бы прозрачные двери в подъезды. Пардон, в дома — в Германии нет подъездов. Такова нумерация. Причем на одной стороне улицы номера возрастают, а на другой — уменьшаются. На фото слева видна кнопка, она включает свет. У нее нет положений, одно нажатие включает свет примерно на минуту.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0662.jpg'])

<p>Е — вход. Первый этаж выше. Лифт после прибытия ждет открытым. В итоге часто еще с улицы видно готов он или нет везти тебя наверх.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0745.jpg'])

<p>Номеров у квартир тоже нет, все по фамилиям. Даже домофон — на нем будет соответствующее количество кнопок. И даже почтовые ящики. Соответственно, при заселении к местным нужно знать адрес и фамилию.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0765.jpg'])

<p>До чего ж хорошо получаются стеклянные здания у немцев.</p>
@include('tpl.fotorama', ['pics' => [
  'IMG_0672.jpg',
  'IMG_0753.jpg',
  'IMG_0754.jpg',
]])

<p>Среди высоток можно спрятаться от жары и перекусить.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0756.jpg'])

<p>Гигантский и многоуровневый центральный вокзал.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0747.jpg'])

<p>Тут и электрички, и метро, и междугородние поезда, и высокоскоростные, и магазины, и ресторанный дворик, и супермаркет, и многое другое.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0693.jpg'])

<p>Некоторые вагоны имеют уникальное оформление.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0702.jpg'])

<p>Ничего необычного, просто вагон-ресторан.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0761.jpg'])

<p>Видно происходящее снаружи.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0695.jpg'])

<p>Школьный автобус будто прямиком из Америки приехал.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0674.jpg'])

<p>Удивительно, но на узком мосту припаркованы автомобили. Наши правила дорожного движения такого не позволяют — для возможности остановки должно быть не менее 3 полос.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0676.jpg'])

<p>Переносные столбы со знаками. Мобильно.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0679.jpg'])

<p>Летом грандиозные масштабы строительства и ремонта.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0680.jpg'])

<p>Ожидания и реальность, когда решил посмотреть дворец в городе.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0723.jpg'])

<p>Такси кремового цвета, в основном одни Мерседесы.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0685.jpg'])

<p>Окрестности этого места на видео.</p>
<div class="fotorama" data-width="1000" data-ratio="16/10">
  <a href="https://www.youtube.com/embed/ZlkiCXxaqQQ">Berlin street, July 2016</a>
</div>

<p>Реклама велосипедных маршрутов, охватывающих всю страну. Велосипед очень популярен.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0688.jpg'])

<p>Их активно перевозят на автомобилях. Их можно прицепить к междугороднему автобусу. Можно провозить в специальных вагонах поездов, но иногда для этого требуется чуть более дорогой билет.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0710.jpg'])

<p>Пути велосипедистов здорово обособляют. Тротуар за зеленью.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0732.jpg'])

<p>Дома достаточно разнообраны. Много красивых.</p>
@include('tpl.fotorama', ['pics' => [
  'IMG_0704.jpg',
  'IMG_0706.jpg',
]])

<p>Местами машины можно парковать по центру дороги.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0716.jpg'])

<p>Цветы на балконах здорово раскрашивают и оживляют дома.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0719.jpg'])

<p>На этом примере особенно заметно, что без цветов было бы уныло. Еще можно заметить как ловко привязали знак дорожных работ   к столбу.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0712.jpg'])

<p>Есть где погулять.</p>
@include('tpl.fotorama', ['pics' => [
  'IMG_0720.jpg',
  'IMG_0748.jpg',
  'IMG_0755.jpg',
]])

<p>Есть где посидеть.</p>
@include('tpl.fotorama', ['pics' => [
  'IMG_0722.jpg',
  'IMG_0724.jpg',
]])

<p>Дороги.</p>
@include('tpl.fotorama', ['pics' => [
  'IMG_0750.jpg',
  'IMG_0751.jpg',
  'IMG_0721.jpg',
  'IMG_0678.jpg',
]])

<p>Детская площадка за симпатичным забором.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0731.jpg'])

<p>Подробное расписание автобуса.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0733.jpg'])

<p>Одноэтажные автобусы наклоняются к тротуару на остановках. На видео заметно как автобус выпрямляется перед отправлением.</p>
<div class="fotorama" data-width="1000" data-ratio="16/10">
  <a href="https://www.youtube.com/embed/gsyMCKccZHg">Berlin tilting bus, July 2016</a>
</div>

<p>Единственное грязное покрытие, после которого понадобилось протирать обувь. За все время пребывания в стране! Фото после прохождения контроля на концерт <a class="link" href="/life/rammstein.2016.07">Раммштайна</a>. Пускали только по именным билетам, сверяли с удостоверяющими личность документами. Такая практика оказалась распространена в Германии. На мой взгляд, это неплохой отпор перекупщикам. В России действуют иначе — билеты в продажу поступают порциями вплоть до даты концерта.</p>
@include('tpl.fotorama', ['pics' => [
  'IMG_0736.jpg',
  'IMG_0738.jpg',
  'IMG_0739.jpg',
]])

<p>Река Шпре. Многие крупные немецкие города расположены вдоль рек.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0760.jpg'])

<p>В этом кинотеатре многие фильмы показывают на английском. Может, место просто такое в деловом районе. Сложно поверить, что сеансы на немецком единичны.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0757.jpg'])

<p>Судя по почтовым ящикам, где-то в этом здании офисы Сони и Фэйсбука.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0758.jpg'])

<p>Ранее упомянутая городская электричка здесь зовется с-бан. Запечатленная линия находится на высоте 2-3 этажа.</p>
<div class="fotorama" data-width="1000" data-ratio="16/10">
  <a href="https://www.youtube.com/embed/Q8hb6jDJY-s">Berlin S-Bahn, July 2016</a>
</div>

<p>В Германии туго с открытым вай-фаем, часто его вовсе не найти. Но есть одна уловка — междугородние автобусы предлагают бесплатный доступ в сеть. Можно подключиться просто находясь неподалеку. А на <a class="link" href="https://www.busradar.com/">busradar.com</a> можно найти оптимальный рейс.</p>
@include('tpl.pic-2x', ['pic' => 'IMG_0766.jpg'])

@include('tpl.airbnb_coupon', ['city' => 'Берлине', 'coupon' => 'BERLIN2015'])
@endsection
