@extends('life.gigs.base')

{{-- ГлавClub --}}

@section('content')
@ru
  <p>Заключительный концерт тура ирландцев. Гитаристы играли на одних и тех же гитарах все шоу, из-за этого чуть ли не каждую песню их перенастраивали — это резало глаз после популярных международных коллективов, где у каждой группы целая команда техников и множество предварительно настроенных инструментов.</p>
@endru

@component('tpl.setlist', ['cover' => 'https://life.ivacuum.org/gigs/giaa.2014.11.23.jpg'])
  <ol>
    <li>When Everything Dies</li>
    <li>Transmissions</li>
    <li>All Is Violent, All Is Bright</li>
    <li>Reverse World</li>
    <li>Echoes</li>
    <li>Spiral Code</li>
    <li>Remembrance Day</li>
    <li>The End of the Beginning</li>
    <li>Fragile</li>
    <li>Calistoga</li>
    <li>Forever Lost</li>
    <li>Worlds in Collision</li>
    <li>The Last March</li>
    <li>From Dust to the Beyond</li>
    <li>Fire Flies And Empty Skies</li>
    <li>Red Moon Lagoon</li>
    <li>Suicide By Star</li>
    <li>Route 666</li>
  </ol>
@endcomponent

@ru
  <p>Несколько фото с концерта.</p>
@endru
@include('tpl.pic', ['pic' => 'IMG_1348.jpg'])
@include('tpl.pic', ['pic' => 'IMG_1349.jpg'])
@endsection
