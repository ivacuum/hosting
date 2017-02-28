@extends('life.gigs.base')

{{-- Stadium Live --}}

@section('content')
@ru
  <p>Впервые побывал на двух концертах группы подряд. С абсолютно одинаковой программой.</p>
@en
  <p>First time in my life I have attended two shows of the same band in a row.</p>
@endlang
<div class="row">
  <div class="col-md-7">
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
  <div class="col-md-5">
    <div class="img-container">
      <img src="https://life.ivacuum.ru/gigs/dreamtheater.2014.02.28.jpg">
    </div>
  </div>
</div>
@endsection
