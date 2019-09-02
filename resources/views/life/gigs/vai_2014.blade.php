@extends('life.gigs.base')

{{-- Калужская областная филармония --}}

@section('content')
<div class="md:flex md:-mx-4">
  <div class="md:w-7/12 md:px-4">
    @ru
      <div class="mb-1">Как попала Калуга в график его гастролей — решительно непонятно:</div>
      <ul class="mb-4">
        <li>10 мая — Утрехт, Голландия</li>
        <li>13 мая — Нанси, Франция</li>
        <li>14 мая — Рим, Италия</li>
        <li>26 мая — Калуга, Россия</li>
        <li>30 мая — Денвер, штат Колорадо, США</li>
      </ul>
      <p>Стив Вай творил с гитарой во время своего полуторачасового выступления нечто невообразимое. Удалось шикануть и взять первый ряд, тем более после покупки билетов на Линкин Парк местные цены были смехотворны. Снова убедился, что как минимум один раз всем стоит взять лучшие места на ожидаемое шоу, так как впечатления потом непередаваемо крутые.</p>
    @endru
    @ru
      <div class="mb-1">Предполагаемый сетлист:</div>
    @en
      <div class="mb-1">Setlist probably was:</div>
    @endru
    <ol class="mb-4">
      <li>Racing the World</li>
      <li>Velorum</li>
      <li>Building the Church</li>
      <li>Tender Surrender</li>
      <li>Gravity Storm</li>
      <li>Weeping China Doll</li>
      <li>Answers</li>
      <li>The Animal</li>
      <li>Whispering a Prayer</li>
      <li>The Audience Is Listening</li>
      <li>The Moon and I</li>
      <li>Rescue Me or Bury Me</li>
      <li>Sisters</li>
      <li>Treasure Island</li>
      <li>Salamanders in the Sun</li>
      <li>Fire Garden Suite II - Pusa Road</li>
      <li>The Ultra Zone</li>
      <li>Frank</li>
      <li>Build Me a Song</li>
      <li>For the Love of God</li>
      <li>Fire Garden Suite IV - Taurus Bulba</li>
    </ol>
  </div>
  <div class="md:w-5/12 md:px-4">
    <div class="mb-6 text-center mobile-wide">
      <img class="image-fit-viewport max-w-full sm:rounded" src="https://life.ivacuum.org/gigs/vai.2014.05.26.jpg">
    </div>
  </div>
</div>

@ru
  <p>Попали под прицел фотокамер.</p>
@en
  <p>Were caught by the cameras.</p>
@endru
@include('tpl.pic-arbitrary', ['pic' => 'Steve_093.jpg', 'w' => 900, 'h' => 600])
@include('tpl.pic-arbitrary', ['pic' => 'Steve_008.jpg', 'w' => 900, 'h' => 600])

@ru
  <p>Видео одной из песен.</p>
@en
  <p>Short footage from the show.</p>
@endru
<youtube title="Steve Vai 2014, Kaluga, Russia" v="OkpMqrPtY7M"></youtube>
@endsection
