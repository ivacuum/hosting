@extends('life.gigs.base')

{{-- СК Олимпийский --}}

@section('content')
<div class="row">
  <div class="col-md-7">
    @ru
      <p>Спустя два дня после Металлики в Олимпийском выступил Линкин Парк. Набор песен мало отличался от <a class="link" href="linkinpark.2014">прошлого года</a>. В этот раз было два флэшмоба: листы с надписью you are always welcome в начале песни #20 и слоеный флаг РФ после песни #23.</p>
    @endlang
    @include('tpl.setlist-title')
    <ol>
      <li>Papercut</li>
      <li>Given Up</li>
      <li>Rebellion</li>
      <li>Points of Authority</li>
      <li>One Step Closer</li>
      <li>A Line in the Sand</li>
      <li>From the Inside</li>
      <li>Runaway</li>
      <li>Wastelands</li>
      <li>Castle of Glass</li>
      <li>Leave Out All the Rest / Shadow of the Day / Iridescent</li>
      <li>Robot Boy</li>
      <li>Joe Hahn Solo</li>
      <li>New Divide</li>
      <li>Breaking the Habit</li>
      <li>Darker Than Blood</li>
      <li>Burn It Down</li>
      <li>Final Masquerade</li>
      <li>Remember the Name</li>
      <li>Welcome</li>
      <li>Numb</li>
      <li>In the End</li>
      <li>Faint</li>
      <li>Waiting for the End</li>
      <li>What I've Done</li>
      <li>Bleed It Out</li>
    </ol>
  </div>
  <div class="col-md-5">
    <div class="img-container">
      <img src="https://life.ivacuum.ru/gigs/linkinpark.2015.08.29.jpg">
    </div>
  </div>
</div>

@ru
  <p>Как шоу смотрелось и слышалось из фан-зоны.</p>
@en
  <p>Fan-zone experience.</p>
@endlang
<div class="js-lazy" data-lazy-type="fotorama" data-width="1000" data-ratio="1000/595">
  <a href="https://www.youtube.com/watch?v=x8i-KQowLZA"></a>
</div>
@endsection
