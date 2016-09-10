@extends('life.trips.base')

@section('content')
@ru
  <p>Вечерняя Москва.</p>
@en
  <p>Evening Moscow.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_1289.jpg',
  'IMG_1297.jpg',
]])

@ru
  <p>Одной из целей поездки была проба гитары <a class="link" href="http://www.sterlingbymusicman.com/jp-guitars/jp100d-series">Sterling by Music Man JP100D</a>. В России вообще всего один <a class="link" href="http://grandm.ru/">официальный дилер компании Music Man</a>, у него и можно пощупать инструменты. Правда, с ростом курса валют он поднял цены на гитары в два раза, так что они резко стали дорогим удовольствием.</p>
@endlang
@include('tpl.pic-arbitrary', ['pic' => 'IMG_1308.jpg', 'w' => 640, 'h' => 640])

@ru
  <p>Сколько раз я уже опаздывал на последний поезд домой? Как минимум при возвращении с фестиваля Рок над Волгой из Самары. Тогда я благополучно скоротал за сном длинные ночные часы в круглосуточном ресторане восточной кухни в Москве. Что ж, опоздал я и в этот день. Хорошо, что нашелся ночлег в Жуковском. Еще днем ранее не думал, что такую картину застану утром.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_1305.jpg'])

@ru
  <p>Или такую.</p>
@en
  <p>Or this one.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_1307.jpg'])
@endsection
