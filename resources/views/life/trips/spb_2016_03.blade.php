@extends('life.trips.base')

@section('content')
@ru
  <p>Раннее прибытие. Метро только открылось.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0039.jpg'])

@ru
  <p>На станции редкие люди.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0041.jpg'])

@ru
  <p>Новая тактика по заселению с помощью <a class="link" href="https://www.airbnb.com/c/spankov1?s=8">Airbnb</a> — снять отдельную комнату вместо целой квартиры. Выходит дешевле, общительнее и интересней. Рекомендую.</p>
  <p>Еще актуально пользоваться акцией РЖД <a class="link" href="https://pass.rzd.ru/static/portal/ru?STRUCTURE_ID=5316">удачный вторник</a>. Весной давали скидку 25-30% на верхние места в плацкарте. Также за 60 дней до отправления можно купить билет на Сапсан всего за 999 рублей.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0044.jpg'])

@ru
  <p>Отдельный турникет на станциях метро отдали под оплату касанием банковской картой. В отдельных троллейбусах бесконтактная оплата тоже вовсю тестируется.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0091.jpg'])

@ru
  <p>Пополнение коллекции фото табличек с фамилиями друзей.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0045.jpg'])

@ru
  <p>Два года назад в Юбилейном проходил концерт <a class="link" href="/life/dreamtheater.2014.spb">Дрим Театра</a>.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0047.jpg'])

@ru
  <p>А на малой арене Петровского стадиона в том же 2014 году играл Линкин Парк. На день позже выступление было <a class="link" href="/life/linkinpark.2014">в Москве</a>.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0064.jpg'])

@ru
  <p>После СПб в других городах недостает таблицы нумерации квартир по этажам.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0072.jpg'])

@ru
  <p>В этот раз больше времени было уделено Василеостровскому району.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0074.jpg'])

@ru
  <p>Как перестать отбрасывать тень.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0075.jpg'])

@ru
  <p>Случайный двор.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0069.jpg'])

@ru
  <p>Дороги.</p>
@endlang
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
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0078.jpg'])

@ru
  <p>Никаких оград.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0084.jpg'])

@ru
  <p>Никаких преград.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0083.jpg'])

@ru
  <p>Осталось загадкой почему тут тепло.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0080.jpg'])

@ru
  <p>А тут холодно.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0081.jpg'])

@ru
  <p><a class="pseudo" data-toggle="feedback" data-target=".js-modal-feedback" data-question="Почему тепло?">Теплое течение?</a></p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0085.jpg'])

@include('tpl.airbnb_coupon', ['city' => 'Санкт-Петербурге', 'coupon' => 'POLOGNE2015'])
@endsection
