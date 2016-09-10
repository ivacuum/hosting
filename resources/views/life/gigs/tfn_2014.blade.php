@extends('life.gigs.base')

{{-- Клуб Б2 --}}

@section('content')
<div class="row">
  <div class="col-md-7">
    @ru
      <p>На концерте всего было около полутора сотен человек — никогда прежде не был на столь малочисленных шоу.</p>
    @endlang
    @include('tpl.setlist-title')
    <ol>
      <li>Sleepmonster</li>
      <li>Hollow Lights</li>
      <li>Only With Presence</li>
      <li>It Takes More Than One Kind of Telescope to See the Light</li>
      <li>Purr</li>
      <li>Laughter of Gods</li>
      <li>Satori</li>
      <li>The Fall of Leviathan</li>
      <li>When There Were No Connections</li>
      <li>Now Run</li>
      <li>Siberia</li>
      <li>Tragedy of Joseph Merrick</li>
    </ol>
  </div>
  <div class="col-md-5">
    <div class="img-container">
      <img src="https://life.ivacuum.ru/gigs/tfn.2014.12.21.jpg">
    </div>
  </div>
</div>
@endsection
