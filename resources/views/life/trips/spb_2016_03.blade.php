@extends('life.trips.base')

@section('content')
@ru
  <p>Раннее прибытие. Метро только открылось.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0039.jpg'])

@ru
  <p>На станции редкие люди.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0041.jpg'])

@ru
  <p>Новая тактика по заселению с помощью <a class="link" href="https://www.airbnb.com/c/spankov1?s=8">Airbnb</a> — снять отдельную комнату вместо целой квартиры. Выходит дешевле, общительнее и интересней. Рекомендую.</p>
@endru

@ru
  <p>Еще актуально пользоваться акцией РЖД <a class="link" href="https://pass.rzd.ru/static/portal/ru?STRUCTURE_ID=5316">удачный вторник</a>. Весной давали скидку 25-30% на верхние места в плацкарте. Также за 60 дней до отправления можно купить билет на Сапсан всего за 999 рублей.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0044.jpg'])

@ru
  <p>Отдельный турникет на станциях метро отдали под оплату касанием банковской картой. В отдельных троллейбусах бесконтактная оплата тоже вовсю тестируется.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0091.jpg'])

@ru
  <p>Пополнение коллекции фото табличек с фамилиями друзей.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0045.jpg'])

@ru
  <p>Два года назад в Юбилейном проходил концерт <a class="link" href="dreamtheater.2014.spb">Дрим Театра</a>.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0047.jpg'])

@ru
  <p>А на малой арене Петровского стадиона в том же 2014 году играл Линкин Парк. На день позже выступление было <a class="link" href="linkinpark.2014">в Москве</a>.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0064.jpg'])

@ru
  <p>После СПб в других городах недостает таблицы нумерации квартир по этажам.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0072.jpg'])

@ru
  <p>В этот раз больше времени было уделено Василеостровскому району.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0074.jpg'])

@ru
  <p>Как перестать отбрасывать тень.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0075.jpg'])

@ru
  <p>Случайный двор.</p>
@en
  <p>Random yard.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0069.jpg'])

<a id="lamps"></a>
@ru
  <p>Дороги.</p>
@en
  <p>Roads.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0062.jpg',
  'IMG_0066.jpg',
  'IMG_0068.jpg',
  'IMG_0076.jpg',
  'IMG_0077.jpg',
  'IMG_0079.jpg',
  'IMG_0088.jpg',
  'IMG_0090.jpg',
]])

@ru
  <p>В таком виде знак легко принять за новый.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0078.jpg'])

@ru
  <p>Никаких оград.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0084.jpg'])

@ru
  <p>Никаких преград.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0083.jpg'])

@ru
  <p>Осталось загадкой почему тут тепло.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0080.jpg'])

@ru
  <p>А тут холодно.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0081.jpg'])

@ru
  <p>Теплое течение?</p>
@en
  <p>Warm current?</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_0085.jpg'])

@include('tpl.airbnb_coupon', ['city' => 'Санкт-Петербурге', 'coupon' => 'POLOGNE2015'])
@endsection
