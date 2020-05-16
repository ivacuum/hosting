@extends('life.gigs.base')

{{-- Arbat Hall --}}

@section('content')
@ru
  <p>Возможность вживую услышать саундтрек к играм детства — серии Command & Conquer (C&C).</p>
@endru

@component('tpl.setlist', ['cover' => 'https://life.ivacuum.org/gigs/frank_klepacki.2020.05.23.jpg'])
  <ol>
    <li>Act on Instinct (C&C)</li>
    <li>Industrial (C&C)</li>
    <li>Target (Mechanical Man) (C&C)</li>
    <li>Prepare for Battle (C&C)</li>
    <li>Rain in the Night (C&C)</li>
    <li>Full Stop / Warfare (C&C)</li>
    <li>Big Foot (w/ intro from C&C: Red Alert)</li>
    <li>Workmen (C&C: Red Alert).</li>
    <li>Crush (C&C: Red Alert)</li>
    <li>Militant Force (C&C: Red Alert)</li>
    <li>Dusk Hour (C&C: Tiberian Sun)</li>
    <li>Mad Rap (C&C: Tiberian Sun)</li>
    <li>No Mercy (C&C, w/ Kane's reappearance from C&C: Tiberian Sun)</li>
    <li>Slave to the System (C&C: Tiberian Sun - Firestorm)</li>
    <li>Got A Present For Ya (from C&C: Renegade)</li>
    <li>Grinder (C&C: Red Alert 2 and 3)</li>
    <li>Blow It Up (C&C: Red Alert 2)</li>
    <li>Brainfreeze Brain Freeze (w/ intro from C&C: Red Alert 2 - Yuri's Revenge) / Smash (C&C: Red Alert, briefly during Klepacki's drum solo)</li>
    <li>Command and Conquer (C&C: Renegade)</li>
    <li>Hell March (C&C: Red Alert)</li>
    <li>Hell March 2 & Hell March 3 (C&C: Red Alert 2 and 3)</li>
  </ol>
@endcomponent

@ru
  <p>Профессиональная видеозапись концерта 2019 года.</p>
@en
  <p>Official video of the MAGFest 2019 show.</p>
@endru
<livewire:youtube title="Frank Klepacki & The Tiberian Sons LIVE: OFFICIAL Multi-cam Full Show from MAGFest 2019" v="i-ArbE0bEQQ"/>
@endsection
