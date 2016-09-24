@extends('life.trips.base')

@section('content')
@ru
  <p>Всего несколько часов на автобусе отделяют Гамбург от Берлина. Удобно, что для посадки достаточно показать qr-код с экрана телефона. Бумажные билеты на транспорт ни разу не пригодились в Германии. Лучше всего поставить мобильные приложения соответствующих транспортных служб, чтобы без интернета иметь доступ к билетам и времени отправления/прибытия. Еще будут приходить уведомления об изменениях в расписании вашего рейса.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0767.jpg'])

@ru
  <p>Количество свободных мест на парковках.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0769.jpg'])

@ru
  <p>Пешеход стоит на велосипеде.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0778.jpg'])

@ru
  <p>Территорию ремонтных работ по всей Германии ограждают одинаковыми красно-белыми заборчиками.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0780.jpg'])

@ru
  <p>Жилой район.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0798.jpg'])

@ru
  <p>Более зеленая его часть.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0799.jpg'])

@ru
  <p>Обилие велосипедов.</p>
@en
  <p>Lots of bicycles.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0797.jpg'])

@ru
  <p>Возможность их пристегнуть.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0897.jpg'])

@ru
  <p>Дома и здания.</p>
@en
  <p>Houses and buildings.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_0805.jpg',
  'IMG_0806.jpg',
  'IMG_0770.jpg',
  'IMG_0774.jpg',
  'IMG_0796.jpg',
  'IMG_0843.jpg',
  'IMG_0896.jpg',
]])

@ru
  <p>Парк в жилом секторе.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0809.jpg'])

@ru
  <p>Он же на видео.</p>
@endlang
<div class="fotorama" data-width="1000" data-ratio="1000/595">
  <a href="https://www.youtube.com/embed/pUyNgQVl_H0">Hamburg street, July 2016</a>
</div>

@ru
  <p>Дороги.</p>
@en
  <p>Roads.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_0768.jpg',
  'IMG_0795.jpg',
  'IMG_0800.jpg',
  'IMG_0801.jpg',
  'IMG_0802.jpg',
  'IMG_0803.jpg',
  'IMG_0811.jpg',
  'IMG_0812.jpg',
  'IMG_0845.jpg',
  'IMG_0846.jpg',
]])

@ru
  <p>Один из перекрестков на видео.</p>
@endlang
<div class="fotorama" data-width="1000" data-ratio="1000/595">
  <a href="https://www.youtube.com/embed/v6E6t12z0dU">Hamburg street, July 2016</a>
</div>

@ru
  <p>Поезда.</p>
@en
  <p>Trains.</p>
@endlang
@include('tpl.fotorama', ['pics' => [
  'IMG_0892.jpg',
  'IMG_0894.jpg',
]])

@ru
  <p>На троутарах тоже паркуются.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0899.jpg'])

@ru
  <p>Невероятный парк Planten un Blomen. Чтоб у нас такие ухоженные места были! Он занимает большую площадь и поделен на множество тематических зон.</p>
@en
  <p>Outstanding park Planten un Blomen. I wish we could have polished places to like this! It occupies a large area and is divided into different thematic zones.</p>
@endlang
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0781.jpg',
  'IMG_0782.jpg',
  'IMG_0783.jpg',
  'IMG_0784.jpg',
  'IMG_0785.jpg',
  'IMG_0786.jpg',
  'IMG_0787.jpg',
  'IMG_0788.jpg',
  'IMG_0789.jpg',
  'IMG_0791.jpg',
  'IMG_0850.jpg',
  'IMG_0851.jpg',
  'IMG_0852.jpg',
  'IMG_0853.jpg',
  'IMG_0856.jpg',
  'IMG_0860.jpg',
  'IMG_0861.jpg',
  'IMG_0862.jpg',
  'IMG_0863.jpg',
  'IMG_0867.jpg',
  'IMG_0868.jpg',
  'IMG_0869.jpg',
  'IMG_0870.jpg',
  'IMG_0872.jpg',
  'IMG_0874.jpg',
  'IMG_0875.jpg',
  'IMG_0885.jpg',
  'IMG_0888.jpg',
  'IMG_0889.jpg',
]])

@ru
  <p>Прикрытый зеленью вход в метро.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0790.jpg'])

@ru
  <p>Место животным пройтись и охладиться.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0792.jpg'])

@ru
  <p>Рядом с парком тоже красота.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0793.jpg'])

@ru
  <p>Здания одно круче другого.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0794.jpg'])

@ru
  <p>Искусно сделанная ливневая канализация.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0848.jpg'])

@ru
  <p>Край делают ниже, чтобы вода стекала в него с дороги и попадала в ливневку. А ведь только недавно шел дождь.</p>
  <p>Еще интересное название улицы на указателе.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0849.jpg'])

@ru
  <p>Железная дорога над головой так и подначивает подумать, что оказался в Нью-Йорке.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0813.jpg'])

@ru
  <p>По ней ходит с-бан — городская электричка.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0814.jpg'])

@ru
  <p>А рядом порт.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0817.jpg'])

@ru
  <p>И ходят судна.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0815.jpg'])

@ru
  <p>И стоят судна.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0818.jpg'])

@ru
  <p>Чумовой район Hafencity.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0824.jpg'])

@ru
  <p>На каждой улице открывается новый вид.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0823.jpg'])

@ru
  <p>Будто прыгаешь то на десятилетия назад, то на десятилетия вперед.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0822.jpg'])

@ru
  <p>Или оказываешься в напоминающей фильм <a class="link" href="https://www.kinopoisk.ru/film/447301/">Начало</a> обстановке.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0821.jpg'])

@ru
  <p>Плетеная мебель напоминает как удобно в ней располагаться в калужском пабе. Здесь и большая компания поместится, и дождь не помеха, и вид на Эльбу — лепота.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0825.jpg'])

@ru
  <p>Баскетбольная площадка с классным прорезиненым покрытием. Впрочем, у велосипедистов в правом нижнем углу уже нет сил на игру.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0826.jpg'])

@ru
  <p>Атмосферы фотографиям добавляет минимальное количество людей в вечер понедельника.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0827.jpg'])

@ru
  <p>И заходящее солнце.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0828.jpg'])

@ru
  <p>Снова минимум людей.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0829.jpg'])

@ru
  <p>Снова солнце.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0833.jpg'])

@ru
  <p>Выставка картин.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0832.jpg'])

@ru
  <p>Светофор для редкого пешехода.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0834.jpg'])

@ru
  <p>Здания разных эпох по обе стороны дороги.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0839.jpg'])

@ru
  <p>Прекрасное место для прогулки и несчетное количество стульев. Прямо за стеной еще одна хорошая и крохотная баскетбольная площадка. Самый кайф, что есть столики, которые в России продолжают исчезать из дворов и парков.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0837.jpg'])

@ru
  <p>Не переставал задаваться вопросом: «Что ж тут так красиво?».</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0842.jpg'])

@ru
  <p><a class="pseudo" data-toggle="feedback" data-target=".js-modal-feedback" data-question="Можно ли смело отправляться в другие портовые города?">Можно ли</a> смело и без особых раздумий отправляться в другие портовые города?</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0844.jpg'])

@ru
  <p>Вода вокруг города и внутри него однозначно плюс.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0838.jpg'])

@ru
  <p>Но на воде плюсы Гамбурга не заканчиваются.</p>
@endlang
@include('tpl.pic-2x', ['pic' => 'IMG_0898.jpg'])

@ru
  <p>Сложно поверить, пока не увидишь собственными глазами, что такая концентрация красот может приходиться на пятичасовую прогулку.</p>
@endlang
@include('tpl.airbnb_coupon', ['city' => 'Гамбурге', 'coupon' => 'ALSACE2015'])
@endsection
