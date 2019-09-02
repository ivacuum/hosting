@extends('life.gigs.base')

{{-- Дворец спорта Лужники --}}

@section('content')
@ru
  <p>Первое выступление группы в России. Билет на шоу купил еще в феврале-марте. Затем выяснилось, что концерт выпал на один день со сложным экзаменом. Последний было решено пропустить и затем пересдать, концерт-то не перенесешь.</p>
  <p>На кой-то фиг уже в одиннадцатом часу утра (Тёма, привет!) я был у места проведения концерта, где, однако, уже расположились ребята, приехавшие еще раньше на поезде из Питера. Двери открыли не раньше 18:00, время удалось скоротать с вышеупомянутыми ребятами. Какая была публика у играющей с начала восьмидесятых группы? Относительно молодая, мне на тот момент было девятнадцать. Обсуждали кто где Дрим Театр впервые услышал, какие любимые альбомы. Мне впервые попалась их <a href="https://www.youtube.com/watch?v=kx1zhwHlj4o" class="link">песня Panic Attack в игре Rock Band</a>, для гитары она была на самом высоком уровне сложности. Сложность и зацепила. Затем достал остальные альбомы. Песни воспринимались тяжело, многие длились более десяти минут и совершенно не укладывались в голове.</p>
  <p>На пятой минуте шоу понял, что сорву голос, если не перестану орать, а ведь еще не начались слова!</p>
@endru
<div class="md:flex md:-mx-4">
  <div class="mb-4 md:w-7/12 md:px-4">
    @include('tpl.setlist-title')
    <ol>
      <li>In the Presence of Enemies Pt. 1</li>
      <li>Beyond This Life</li>
      <li>Take the Time</li>
      <li>A Rite of Passage</li>
      <li>Hollow Years</li>
      <li>Panic Attack</li>
      <li>Erotomania</li>
      <li>Voices</li>
      <li>Solitary Shell</li>
      <li>Constant Motion</li>
      <li>The Spirit Carries On</li>
      <li>As I Am</li>
      <li>Pull Me Under</li>
      <li>Metropolis Pt. 1 / Learning to Live / A Change of Seasons</li>
    </ol>
  </div>
  <div class="md:w-5/12 md:px-4">
    <div class="mb-6 text-center mobile-wide">
      <img class="sm:rounded" src="https://life.ivacuum.org/gigs/dreamtheater.2009.06.10.jpg">
    </div>
  </div>
</div>

@ru
  <p>Видеозапись выступления.</p>
@endru
<youtube title="Dream Theater 2009, Moscow, Russia" v="eDqIfvtmalM"></youtube>
@endsection
