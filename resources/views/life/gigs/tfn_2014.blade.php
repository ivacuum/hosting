@extends('life.gigs.base')

{{-- Клуб Б2 --}}

@section('content')
@ru
  <p>На концерте всего было около полутора сотен человек — никогда прежде не был на столь малочисленных шоу.</p>
@endru
<div class="md:tw-flex md:tw--mx-4">
  <div class="md:tw-w-7/12 md:tw-px-4">
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
  <div class="md:tw-w-5/12 md:tw-px-4">
    <div class="img-container">
      <img src="https://life.ivacuum.org/gigs/tfn.2014.12.21.jpg">
    </div>
  </div>
</div>
@endsection
