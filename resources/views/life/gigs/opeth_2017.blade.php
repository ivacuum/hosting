@extends('life.gigs.base')

{{-- ГлавClub --}}

@section('content')
@ru
  <p>Повторение <a class="link" href="opeth.2016">брюссельской программы</a> в укороченном виде — тогда исполнение было лучше, а у нас зато всегда активная и громкая публика по сравнению с европейской. В целом концерт можно было пропускать — увидеть одно шоу тура достаточно.</p>
@endru

@component('tpl.setlist', ['cover' => 'https://life.ivacuum.org/gigs/opeth.2017.10.11.jpg'])
  <ol>
    <li>Sorceress</li>
    <li>Ghost of Perdition</li>
    <li>Demon of the Fall</li>
    <li>The Wilde Flowers</li>
    <li>In My Time of Need</li>
    <li>Cusp of Eternity</li>
    <li>Heir Apparent</li>
    <li>The Drapery Falls</li>
    <li>Deliverance</li>
  </ol>
@endcomponent

@ru
  <p>Видеозапись выступления.</p>
@endru
<livewire:youtube title="Opeth 2017, Moscow, Russia" v="URhBcvRpt14"/>
@endsection
