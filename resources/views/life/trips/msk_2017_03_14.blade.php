@extends('life.trips.base')

@section('content')
@ru
  <p>Панорама вокзала Калуга-1.</p>
@en
  <p>Panorama of Kaluga-1 station.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3721.jpg',
  'IMG_3722.jpg',
]])

@ru
  <p>Смотри как умею.</p>
@en
  <p>Look what I can.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3724.jpg'])

@ru
  <p>Прибывает экспресс из Москвы.</p>
@en
  <p>Express from Moscow arrives.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3726.jpg'])

@ru
  <p>Наклейки поклеили, а вай-фая в поезде Москва–Калуга еще нет.</p>
@en
  <p>Stickers are in place, but still there is no actual wi-fi on Moscow–Kaluga train.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3718.jpg'])

@ru
  <p>Нара — прям как <a class="link" href="nara.2017">городок на другом конце света</a>. А здесь подразумевается станция в Наро-Фоминске.</p>
@en
  <p>Nara. Just like <a class="link" href="nara.2017">the city on the other side of the world</a>. But right here it means a station in Naro-Fominsk city.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3714.jpg'])

@ru
  <p>Посольство Японии в России. При нем же консульство, в котором можно подать документы на визу.</p>
@en
  <p>Embassy of Japan in Russia. There is a consulate in it, where you can apply for a visa.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3729.jpg'])

@ru
  <p>Остановка общественного транспорта. Хорошая табличка с маршрутами.</p>
@en
  <p>Public transport stop. Good plate with routes.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3732.jpg'])

@ru
  <p>Места для прогулок.</p>
@en
  <p>Places for a walk.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3730.jpg',
  'IMG_3738.jpg',
  'IMG_3744.jpg',
]])

@ru
  <p>Сколько кирпичей на той стороне дороги?</p>
@en
  <p>How many no entry road signs on the other side of the road do you see?</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3734.jpg'])

@ru
  <p>Где еще встретишь таймер светофора с более чем 100 секундами ожидания?</p>
@en
  <p>Where else will you meet a traffic light with more than 100 seconds of waiting time?</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3735.jpg',
  'IMG_3742.jpg',
]])

@ru
  <p>Улицы.</p>
@en
  <p>Streets.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3727.jpg',
  'IMG_3728.jpg',
  'IMG_3731.jpg',
  'IMG_3733.jpg',
  'IMG_3740.jpg',
  'IMG_3741.jpg',
  'IMG_3745.jpg',
  'IMG_3747.jpg',
]])

@ru
  <p>Фасады.</p>
@en
  <p>Facades.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3739.jpg',
  'IMG_3746.jpg',
]])

@ru
  <p>Обособленная велодорожка.</p>
@en
  <p>Protected cycle lane.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3743.jpg'])

@ru
  <p>Площадь Киевского вокзала всегда полна людей.</p>
@en
  <p>Kiyevskogo Vokzala square is always full of people.</p>
@endru
@include('tpl.pic-2x', ['pic' => 'IMG_3748.jpg'])

@ru
  <p>Закат перед возвращением в Калугу.</p>
@en
  <p>Sunset before going back to Kaluga.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_3749.jpg',
  'IMG_3752.jpg',
  'IMG_3753.jpg',
  'IMG_3754.jpg',
  'IMG_3756.jpg',
]])
@endsection
