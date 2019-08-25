@extends('life.gigs.base')

{{-- Stadium Live --}}

@section('content')
@ru
  <p>Впервые побывал на двух концертах группы подряд. С абсолютно одинаковой программой.</p>
@en
  <p>First time in my life I have attended two shows of the same band in a row.</p>
@endru

@ru
  <p>Вылет из <a class="link" href="dreamtheater.2014.spb">Петербурга</a> немного задержали. Где-то в 16:45 взлетели, в 17:50 сели во Внуково, двери восемнадцатичасового аэроэкспресса до Киевского вокзала закрылись прямо у меня перед носом. Благо концерт начинался в 20:00, поэтому еще было время в запасе. В Москве все сразу не задалось: суматоха, холод, ужасный интернет (после питерского). Я был с сумками, поэтому пришлось на вокзале сдать их в камеру хранения, ибо в гардероб бы их точно не приняли.</p>
  <p>Примерно в 19:45 приехал на площадку, а там снаружи некислых размеров очередь. Это тебе не отдельный вип-вход с досрочным запуском. Сам зал уже был прилично подзабит. Разница кардинальная. И впечатления совершенно другие. Сетлист играли один в один, но отличались импровизации — на то они и импровизации.</p>
  <p>Активно перемещался по залу, изучал звук, смотрел на поведение людей. В голове были мысли: «Эх, знали бы вы что я парой дней ранее испытал, в каких красках я все видел! Да ладно, так все просто будут стоять и смотреть? Капец, лучше бы я правда этой пассивности не видел!» Все это жутко угнетало. За несколько песен до конца покинул зал, чтобы забрать вещи из камеры хранения на вокзале. Вывод один — не стоит после пятизвездочного отеля ехать в хостел. Рад, что в этом плане была наглядная возможность сравнить оба шоу.</p>
@endru
<div class="md:flex md:-mx-4">
  <div class="md:w-7/12 md:px-4">
    @include('tpl.setlist-title')
    <ol>
      <li>The Enemy Inside</li>
      <li>The Shattered Fortress</li>
      <li>On the Backs of Angels</li>
      <li>The Looking Glass</li>
      <li>Trial of Tears</li>
      <li>Enigma Machine</li>
      <li>Along for the Ride</li>
      <li>Breaking All Illusions</li>
      <li>The Mirror</li>
      <li>Lie</li>
      <li>Lifting Shadows Off a Dream</li>
      <li>Scarred</li>
      <li>Space-Dye Vest</li>
      <li>Illumination Theory</li>
      <li>Overture 1928</li>
      <li>Strange Déjà Vu</li>
      <li>The Dance of Eternity</li>
      <li>Finally Free</li>
    </ol>
  </div>
  <div class="md:w-5/12 md:px-4">
    <div class="mb-6 text-center mobile-wide">
      <img class="image-fit-viewport max-w-full sm:rounded" src="https://life.ivacuum.org/gigs/dreamtheater.2014.02.28.jpg">
    </div>
  </div>
</div>

@ru
  <p>Несколько фото с концерта.</p>
@endru
@include('tpl.fotorama-2x', ['pics' => [
  'IMG_0423.jpg',
  'IMG_0424.jpg',
]])
@endsection
