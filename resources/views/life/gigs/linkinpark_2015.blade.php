@extends('life.gigs.base')

{{-- СК Олимпийский --}}

@section('content')
<div class="md:tw-flex md:tw--mx-4">
  <div class="md:tw-w-7/12 md:tw-px-4">
    @ru
      <p>Спустя два дня после Металлики в Олимпийском выступил Линкин Парк. Набор песен мало отличался от <a class="link" href="linkinpark.2014">прошлого года</a>. В этот раз было два флэшмоба: листы с надписью you are always welcome в начале песни #20 и слоеный флаг РФ после песни #23.</p>
    @endru
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
  <div class="md:tw-w-5/12 md:tw-px-4">
    <div class="tw-mb-6 tw-text-center tw-mobile-wide">
      <img class="image-fit-viewport tw-max-w-full sm:tw-rounded" src="https://life.ivacuum.org/gigs/linkinpark.2015.08.29.jpg">
    </div>
  </div>
</div>

@ru
  <p>Как шоу смотрелось и слышалось из фан-зоны.</p>
@en
  <p>Fan-zone experience.</p>
@endru
<youtube title="Linkin Park 2015, Moscow, Russia" v="x8i-KQowLZA"></youtube>
@endsection
